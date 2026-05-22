<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Mail\ContentCreatedMail;
use App\Models\Character;
use App\Models\Game;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return Character::select('id', 'name', 'slug', 'image')
                ->orderByRaw('RAND()')
                ->paginate($request->query('per_page', 6));
        }

        $characters = Character::with(['game', 'location'])->orderBy('name')->paginate(10);
        return view('admin.characters.index', compact('characters'));
    }

    public function show(Request $request, Character $character)
    {
        if ($request->wantsJson()) {
            return $character;
        }

        return view('admin.characters.show', compact('character'));
    }

    public function create()
    {
        $games     = Game::orderBy('title')->get();
        $locations = Location::orderBy('name')->get();
        return view('admin.characters.create', compact('games', 'locations'));
    }

    public function store(StoreCharacterRequest $request)
    {
        $character = Character::create($request->validated());

        $this->notifyAdmins('character', $character->name);

        if ($request->wantsJson()) {
            return response()->json($character, 201);
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

    public function update(UpdateCharacterRequest $request, Character $character)
    {
        $character->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($character);
        }

        return redirect()->route('admin.characters.index')
            ->with('success', 'Personaje actualizado correctamente.');
    }

    public function destroy(Request $request, Character $character)
    {
        $character->delete();

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('admin.characters.index')
            ->with('success', 'Personaje eliminado correctamente.');
    }
}
