<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Http\Resources\GameResource;
use App\Mail\ContentCreatedMail;
use App\Models\Game;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class GameController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection|View
    {
        if ($request->wantsJson()) {
            $games = Game::orderByRaw('RAND()')
                ->paginate($request->query('per_page', 6));

            return GameResource::collection($games);
        }

        $games = Game::orderBy('release_year')->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    public function show(Request $request, Game $game): GameResource|View
    {
        if ($request->wantsJson()) {
            return new GameResource($game);
        }

        return view('admin.games.show', compact('game'));
    }

    public function create(): View
    {
        return view('admin.games.create');
    }

    public function store(StoreGameRequest $request): JsonResponse|RedirectResponse
    {
        $game = Game::create($request->validated());

        $this->notifyAdmins('game', $game->title);

        if ($request->wantsJson()) {
            return (new GameResource($game))->response()->setStatusCode(201);
        }

        return redirect()->route('admin.games.index')
            ->with('success', 'Juego creado correctamente.');
    }

    public function edit(Game $game): View
    {
        return view('admin.games.edit', compact('game'));
    }

    public function update(UpdateGameRequest $request, Game $game): GameResource|RedirectResponse
    {
        $game->update($request->validated());

        if ($request->wantsJson()) {
            return new GameResource($game->fresh());
        }

        return redirect()->route('admin.games.index')
            ->with('success', 'Juego actualizado correctamente.');
    }

    public function destroy(Request $request, Game $game): JsonResponse|RedirectResponse
    {
        $game->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('admin.games.index')
            ->with('success', 'Juego eliminado correctamente.');
    }

    private function notifyAdmins(string $type, string $name): void
    {
        $creator = Auth::user()?->name ?? 'Sistema';
        User::where('role', 'admin')->each(function (User $admin) use ($type, $name, $creator) {
            Mail::to($admin->email)->queue(new ContentCreatedMail($type, $name, $creator));
        });
    }
}
