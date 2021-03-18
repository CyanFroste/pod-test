<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'extra' => 'array',
        'favorite' => 'boolean',
        'hentai' => 'boolean',
        'movie' => 'boolean'
    ];

    public function hentai()
    {
        return $this->hasMany(Hentai::class);
    }

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

}
