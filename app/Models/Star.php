<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'extra' => 'array',
        'favorite' => 'boolean'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_star');
    }
}
