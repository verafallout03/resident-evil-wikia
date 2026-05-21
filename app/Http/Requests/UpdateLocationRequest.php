<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $locationId = $this->route('location')->id ?? null;

        return [
            'name'         => 'required|string|max:255',
            'slug'         => "required|string|max:255|unique:locations,slug,{$locationId}",
            'region'       => 'nullable|string|max:255',
            'country'      => 'nullable|string|max:100',
            'description'  => 'nullable|string',
            'image'        => 'nullable|string',
            'is_published' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'slug.required' => 'El slug es obligatorio.',
            'slug.unique'   => 'Ya existe una locación con ese slug.',
        ];
    }
}
