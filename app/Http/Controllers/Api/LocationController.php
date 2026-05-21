<?php
 
namespace App\Http\Controllers\Api;
 
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
class LocationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        
        return Location::select('id', 'name', 'slug', 'image')
            ->orderByRaw('RAND()')
            ->paginate($perPage);
    }
 
    public function show($slug)
    {
        return Location::where('slug', $slug)->firstOrFail();
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|unique:locations|max:255',
            'image'       => 'required|string',
            'region'      => 'nullable|string',
            'country'     => 'nullable|string',
            'description' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);
 
        return Location::create($data);
    }
 
    public function update(Request $request, $slug)
    {
        $location = Location::where('slug', $slug)->firstOrFail();
        
        $data = $request->validate([
            'name'        => 'sometimes|string|max:255',
            'slug'        => 'sometimes|unique:locations,slug,' . $location->id,
            'image'       => 'sometimes|string',
            'region'      => 'nullable|string',
            'country'     => 'nullable|string',
            'description' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);
 
        $location->update($data);
        return $location;
    }
 
    public function destroy($slug)
    {
        $location = Location::where('slug', $slug)->firstOrFail();
        $location->delete();
        return response()->noContent();
    }
}