<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return Location::select('id', 'name', 'slug', 'image')
                ->orderByRaw('RAND()')
                ->paginate($request->query('per_page', 12));
        }

        $locations = Location::withCount('characters')->orderBy('name')->paginate(10);
        return view('admin.locations.index', compact('locations'));
    }

    public function show(Request $request, Location $location)
    {
        if ($request->wantsJson()) {
            return $location;
        }

        return view('admin.locations.show', compact('location'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(StoreLocationRequest $request)
    {
        $location = Location::create($request->validated());

        if ($request->wantsJson()) {
            return response()->json($location, 201);
        }

        return redirect()->route('admin.locations.index')
            ->with('success', 'Locación creada correctamente.');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($location);
        }

        return redirect()->route('admin.locations.index')
            ->with('success', 'Locación actualizada correctamente.');
    }

    public function destroy(Request $request, Location $location)
    {
        $location->delete();

        if ($request->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('admin.locations.index')
            ->with('success', 'Locación eliminada correctamente.');
    }
}
