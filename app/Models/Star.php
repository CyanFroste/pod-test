<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    protected $guarded = [];

    protected $casts = [
        'extra' => 'array',
        'actor' => 'boolean',
        'cosplayer' => 'boolean',
        'model' => 'boolean',
        'favorite' => 'boolean',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_star');
    }
}
