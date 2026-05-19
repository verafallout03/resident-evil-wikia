<?php

namespace App\Http\Controllers\Api;

use App\Models\Character;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CharacterController extends Controller
{
    public function index(Request $request)
    {
        return Character::select('id','name','slug','image')
            ->orderByRaw('RAND()')
            ->paginate($request->get('per_page', 12));
    }

    public function show($slug)
    {
        return Character::where('slug', $slug)->firstOrFail();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|unique:characters|max:255',
            'image'       => 'required|string',
            'alias'       => 'nullable|string',
            'nationality' => 'nullable|string',
            'status'      => 'nullable|string',
            'description' => 'nullable|string',
            'lore'        => 'nullable|string',
            'birth_date'  => 'nullable|string',
            'height_cm'   => 'nullable|integer',
            'blood_type'  => 'nullable|string',
        ]);
        return Character::create($data);
    }

    public function update(Request $request, $slug)
    {
        $character = Character::where('slug', $slug)->firstOrFail();
        $character->update($request->validate([
            'name'        => 'sometimes|string|max:255',
            'image'       => 'sometimes|string',
            'alias'       => 'nullable|string',
            'nationality' => 'nullable|string',
            'status'      => 'nullable|string',
            'description' => 'nullable|string',
            'lore'        => 'nullable|string',
            'birth_date'  => 'nullable|string',
            'height_cm'   => 'nullable|integer',
            'blood_type'  => 'nullable|string',
        ]));
        return $character;
    }

    public function destroy($slug)
    {
        $character = Character::where('slug', $slug)->firstOrFail();
        $character->delete();
        return response()->noContent();
    }
}