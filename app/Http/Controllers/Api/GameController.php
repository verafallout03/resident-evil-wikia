<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        
        return Game::select('id', 'title as name', 'slug', 'cover_image as image')
            ->orderByRaw('RAND()')
            ->paginate($perPage);
    }

    public function show($slug)
    {
        return Game::where('slug', $slug)->firstOrFail();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|unique:games|max:255',
            'cover_image' => 'required|string',
            'release_year' => 'nullable|integer',
            'platform'    => 'nullable|string',
            'developer'   => 'nullable|string',
            'synopsis'    => 'nullable|string',
            'canon'       => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        return Game::create($data);
    }

    public function update(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        
        $data = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'slug'        => 'sometimes|unique:games,slug,' . $game->id,
            'cover_image' => 'sometimes|string',
            'release_year' => 'nullable|integer',
            'platform'    => 'nullable|string',
            'developer'   => 'nullable|string',
            'synopsis'    => 'nullable|string',
            'canon'       => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);

        $game->update($data);
        return $game;
    }

    public function destroy($slug)
    {
        $game = Game::where('slug', $slug)->firstOrFail();
        $game->delete();
        return response()->noContent();
    }
}