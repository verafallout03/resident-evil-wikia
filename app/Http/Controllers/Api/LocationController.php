<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Mail\ContentCreatedMail;
use App\Models\Location;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LocationController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection|View
    {
        if ($request->wantsJson()) {
            $locations = Location::orderByRaw('RAND()')
                ->paginate($request->query('per_page', 6));

            return LocationResource::collection($locations);
        }

        $locations = Location::withCount('characters')->orderBy('name')->paginate(10);
        return view('admin.locations.index', compact('locations'));
    }

    public function show(Request $request, Location $location): LocationResource|View
    {
        if ($request->wantsJson()) {
            return new LocationResource($location);
        }

        return view('admin.locations.show', compact('location'));
    }

    public function create(): View
    {
        return view('admin.locations.create');
    }

    public function store(StoreLocationRequest $request): JsonResponse|RedirectResponse
    {
        $location = Location::create($request->validated());

        $this->notifyAdmins('location', $location->name);

        if ($request->wantsJson()) {
            return (new LocationResource($location))->response()->setStatusCode(201);
        }

        return redirect()->route('admin.locations.index')
            ->with('success', 'Locación creada correctamente.');
    }

    public function edit(Location $location): View
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(UpdateLocationRequest $request, Location $location): LocationResource|RedirectResponse
    {
        $location->update($request->validated());

        if ($request->wantsJson()) {
            return new LocationResource($location->fresh());
        }

        return redirect()->route('admin.locations.index')
            ->with('success', 'Locación actualizada correctamente.');
    }

    public function destroy(Request $request, Location $location): JsonResponse|RedirectResponse
    {
        $location->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('admin.locations.index')
            ->with('success', 'Locación eliminada correctamente.');
    }

    private function notifyAdmins(string $type, string $name): void
    {
        $creator = Auth::user()?->name ?? 'Sistema';
        User::where('role', 'admin')->each(function (User $admin) use ($type, $name, $creator) {
            Mail::to($admin->email)->queue(new ContentCreatedMail($type, $name, $creator));
        });
    }
}
