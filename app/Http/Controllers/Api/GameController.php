<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return Game::select('id', 'title as name', 'slug', 'cover_image as image')
                ->orderByRaw('RAND()')
                ->paginate($request->get('per_page', 12));
        }

        $games = Game::orderBy('release_year')->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    public function show(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();

        if ($request->wantsJson()) {
            return $game;
        }

        return view('admin.games.show', compact('game'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(StoreGameRequest $request)
    {
        $game = Game::create($request->validated());

        if ($request->wantsJson()) {
            return response()->json($game, 201);
        }

        return redirect()->route('admin.games.index')
            ->with('success', 'Juego creado correctamente.');
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    public function update(UpdateGameRequest $request, Game $game)
    {
        $game->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($game);
        }

        return redirect()->route('admin.games.index')
            ->with('success', 'Juego actualizado correctamente.');
    }

    public function destroy(Request $request, Game $game)
    {
        $game->delete();

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('admin.games.index')
            ->with('success', 'Juego eliminado correctamente.');
    }
}
