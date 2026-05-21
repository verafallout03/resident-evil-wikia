<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'alias',
        'faction',
        'status',
        'description',
        'image',
        'nationality',
        'blood_type',
        'height_cm',
        'birth_date',
        'is_playable',
        'is_published',
        'lore',
        'game_id',
        'location_id',
    ];

    protected $casts = [
        'birth_date'   => 'date',
        'is_playable'  => 'boolean',
        'is_published' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relaciones
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
