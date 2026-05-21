<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Game;
use App\Models\Location;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $games     = Game::orderBy('title')->get(['id', 'title']);
        $locations = Location::orderBy('name')->get(['id', 'name']);

        return view('admin.reports.index', compact('games', 'locations'));
    }

    public function characters(Request $request)
    {
        $query = Character::with(['game', 'location'])->orderBy('name');

        if ($request->filled('faction')) {
            $query->where('faction', $request->faction);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('game_id')) {
            $query->where('game_id', $request->game_id);
        }
        if ($request->filled('is_playable')) {
            $query->where('is_playable', (bool) $request->is_playable);
        }

        $characters = $query->get();
        $filters    = $request->only(['faction', 'status', 'game_id', 'is_playable']);
        $games      = Game::orderBy('title')->get(['id', 'title']);

        $pdf = Pdf::loadView('reports.characters', compact('characters', 'filters', 'games'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('personajes_' . now()->format('Ymd_His') . '.pdf');
    }

    public function games(Request $request)
    {
        $query = Game::withCount('characters')->orderBy('release_year');

        if ($request->filled('canon')) {
            $query->where('canon', $request->canon);
        }
        if ($request->filled('year_from')) {
            $query->where('release_year', '>=', (int) $request->year_from);
        }
        if ($request->filled('year_to')) {
            $query->where('release_year', '<=', (int) $request->year_to);
        }

        $games   = $query->get();
        $filters = $request->only(['canon', 'year_from', 'year_to']);

        $pdf = Pdf::loadView('reports.games', compact('games', 'filters'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('juegos_' . now()->format('Ymd_His') . '.pdf');
    }

    public function locations(Request $request)
    {
        $query = Location::withCount('characters')->orderBy('name');

        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }
        if ($request->filled('region')) {
            $query->where('region', 'like', '%' . $request->region . '%');
        }

        $locations = $query->get();
        $filters   = $request->only(['country', 'region']);

        $pdf = Pdf::loadView('reports.locations', compact('locations', 'filters'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('locaciones_' . now()->format('Ymd_His') . '.pdf');
    }
}
