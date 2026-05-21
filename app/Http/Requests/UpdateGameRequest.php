<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $gameId = $this->route('game')->id ?? null;

        return [
            'title'        => 'required|string|max:255',
            'slug'         => "required|string|max:255|unique:games,slug,{$gameId}",
            'release_year' => 'required|integer|min:1996|max:2100',
            'platform'     => 'required|string|max:255',
            'developer'    => 'nullable|string|max:255',
            'cover_image'  => 'nullable|string',
            'synopsis'     => 'nullable|string',
            'canon'        => 'required|in:main,spin-off,remake',
            'is_published' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'        => 'El título es obligatorio.',
            'slug.required'         => 'El slug es obligatorio.',
            'slug.unique'           => 'Ya existe un juego con ese slug.',
            'release_year.required' => 'El año de lanzamiento es obligatorio.',
            'release_year.min'      => 'El año mínimo es 1996.',
            'platform.required'     => 'La plataforma es obligatoria.',
            'canon.required'        => 'El tipo de canon es obligatorio.',
            'canon.in'              => 'El canon debe ser: main, spin-off o remake.',
        ];
    }
}
