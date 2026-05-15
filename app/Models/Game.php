<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'release_year',
        'platform',
        'developer',
        'cover_image',
        'synopsis',
        'canon',
        'is_published',
    ];

    // Relaciones
    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
}
