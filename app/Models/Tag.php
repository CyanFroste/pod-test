<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_tag');
    }

    public function hentai()
    {
        return $this->belongsToMany(Hentai::class, 'hentai_tag');
    }
}
