<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'slug'         => $this->slug,
            'release_year' => $this->release_year,
            'platform'     => $this->platform,
            'developer'    => $this->developer,
            'cover_image'  => $this->cover_image,
            'synopsis'     => $this->synopsis,
            'canon'        => $this->canon,
            'is_published' => $this->is_published,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
