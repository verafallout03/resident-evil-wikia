<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Http\Resources\CharacterResource;
use App\Mail\ContentCreatedMail;
use App\Models\Character;
use App\Models\Game;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CharacterController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection|JsonResponse
    {
        if ($request->wantsJson()) {
            $characters = Character::with(['game', 'location'])
                ->orderByRaw('RAND()')
                ->paginate($request->query('per_page', 6));

            return CharacterResource::collection($characters);
        }

        $characters = Character::with(['game', 'location'])->orderBy('name')->paginate(10);
        return view('admin.characters.index', compact('characters'));
    }

    public function show(Request $request, Character $character): CharacterResource|JsonResponse
    {
        if ($request->wantsJson()) {
            return new CharacterResource($character->load(['game', 'location']));
        }

        return view('admin.characters.show', compact('character'));
    }

    public function create()
    {
        $games     = Game::orderBy('title')->get();
        $locations = Location::orderBy('name')->get();
        return view('admin.characters.create', compact('games', 'locations'));
    }

    public function store(StoreCharacterRequest $request): CharacterResource|JsonResponse
    {
        $character = Character::create($request->validated());

        $this->notifyAdmins('character', $character->name);

        if ($request->wantsJson()) {
            return (new CharacterResource($character))->response()->setStatusCode(201);
        }

        return redirect()->route('admin.characters.index')
            ->with('success', 'Personaje creado correctamente.');
    }

    public function edit(Character $character)
    {
        $games     = Game::orderBy('title')->get();
        $locations = Location::orderBy('name')->get();
        return view('admin.characters.edit', compact('character', 'games', 'locations'));
    }

    public function update(UpdateCharacterRequest $request, Character $character): CharacterResource|JsonResponse
    {
        $character->update($request->validated());

        if ($request->wantsJson()) {
            return new CharacterResource($character->fresh()->load(['game', 'location']));
        }

        return redirect()->route('admin.characters.index')
            ->with('success', 'Personaje actualizado correctamente.');
    }

    public function destroy(Request $request, Character $character): JsonResponse
    {
        $character->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('admin.characters.index')
            ->with('success', 'Personaje eliminado correctamente.');
    }

    private function notifyAdmins(string $type, string $name): void
    {
        $creator = Auth::user()?->name ?? 'Sistema';
        User::where('role', 'admin')->each(function (User $admin) use ($type, $name, $creator) {
            Mail::to($admin->email)->queue(new ContentCreatedMail($type, $name, $creator));
        });
    }
}
