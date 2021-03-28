<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'extra' => 'array',
        'favorite' => 'boolean',
    ];

    public function stars()
    {
        return $this->belongsToMany(Star::class, 'movie_star');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'movie_tag');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    // scopes
    // public function scopeTagged($query, $tag)
    // {
    //     $query->whereHas('tags', function ($query) use ($tag) {
    //         $query->where('name', $tag);
    //     });
    // }

}
