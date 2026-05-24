<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'slug'         => $this->slug,
            'alias'        => $this->alias,
            'faction'      => $this->faction,
            'status'       => $this->status,
            'description'  => $this->description,
            'image'        => $this->image,
            'nationality'  => $this->nationality,
            'blood_type'   => $this->blood_type,
            'height_cm'    => $this->height_cm,
            'birth_date'   => $this->birth_date?->toDateString(),
            'is_playable'  => $this->is_playable,
            'is_published' => $this->is_published,
            'lore'         => $this->lore,
            'game_id'      => $this->game_id,
            'location_id'  => $this->location_id,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
