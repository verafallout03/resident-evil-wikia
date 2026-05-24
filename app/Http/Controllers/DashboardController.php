<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Game;
use App\Models\Location;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('dashboard.admin'),
            default => redirect()->route('dashboard.editor'),
        };
    }

    public function admin(): View
    {
        $factionData = Character::select('faction', DB::raw('count(*) as total'))
            ->whereNotNull('faction')
            ->groupBy('faction')
            ->orderByDesc('total')
            ->get();

        $gamesByYear = Game::select('release_year', DB::raw('count(*) as total'))
            ->groupBy('release_year')
            ->orderBy('release_year')
            ->get();

        $stats = [
            'games'      => Game::count(),
            'characters' => Character::count(),
            'locations'  => Location::count(),
            'users'      => User::count(),
        ];

        return view('dashboard.admin', compact('factionData', 'gamesByYear', 'stats'));
    }

    public function editor(): View
    {
        $statusData = Character::select('status', DB::raw('count(*) as total'))
            ->whereNotNull('status')
            ->groupBy('status')
            ->orderByDesc('total')
            ->get();

        $locationsByCountry = Location::select('country', DB::raw('count(*) as total'))
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $stats = [
            'published_characters' => Character::where('is_published', true)->count(),
            'published_games'      => Game::where('is_published', true)->count(),
            'published_locations'  => Location::where('is_published', true)->count(),
            'playable_characters'  => Character::where('is_playable', true)->count(),
        ];

        return view('dashboard.editor', compact('statusData', 'locationsByCountry', 'stats'));
    }
}
