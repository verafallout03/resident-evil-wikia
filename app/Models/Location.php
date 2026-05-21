<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'region',
        'country',
        'description',
        'image',
        'is_published',
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
