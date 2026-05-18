<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class DashboardGeneral extends Component
{
    use WithPagination;

    public function render()
    {
        $items = DB::table('characters')
            ->select('id','name','slug','image', DB::raw("'character' as type"))
            ->union(
                DB::table('locations')
                    ->select('id','name','slug','image', DB::raw("'location' as type"))
            )
            ->union(
                DB::table('games')
                    ->select('id','title as name','slug','cover_image as image', DB::raw("'game' as type"))
            )
            ->orderByRaw('RAND()')
            ->paginate(12);

        return view('dashboard-general', compact('items'));
    }
}
