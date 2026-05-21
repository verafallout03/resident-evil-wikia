<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCharacterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $characterId = $this->route('character')->id ?? null;

        return [
            'name'        => 'required|string|max:255',
            'slug'        => "required|string|max:255|unique:characters,slug,{$characterId}",
            'alias'       => 'nullable|string|max:255',
            'faction'     => 'nullable|in:S.T.A.R.S.,B.S.A.A.,Umbrella,Neo-Umbrella,The Connections,Independent,Villain,Infected,Unknown',
            'status'      => 'nullable|in:alive,deceased,unknown,mutated',
            'description' => 'nullable|string',
            'image'       => 'nullable|string',
            'nationality' => 'nullable|string|max:100',
            'blood_type'  => 'nullable|string|max:5',
            'height_cm'   => 'nullable|integer|min:50|max:300',
            'birth_date'  => 'nullable|date',
            'is_playable'  => 'boolean',
            'is_published' => 'boolean',
            'lore'        => 'nullable|string',
            'game_id'     => 'nullable|exists:games,id',
            'location_id' => 'nullable|exists:locations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'El nombre es obligatorio.',
            'slug.required'      => 'El slug es obligatorio.',
            'slug.unique'        => 'Ya existe un personaje con ese slug.',
            'faction.in'         => 'La facción seleccionada no es válida.',
            'status.in'          => 'El estado debe ser: alive, deceased, unknown o mutated.',
            'height_cm.min'      => 'La altura mínima es 50 cm.',
            'height_cm.max'      => 'La altura máxima es 300 cm.',
            'birth_date.date'    => 'La fecha de nacimiento debe ser una fecha válida.',
            'game_id.exists'     => 'El juego seleccionado no existe.',
            'location_id.exists' => 'La locación seleccionada no existe.',
        ];
    }
}
