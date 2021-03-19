<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $guarded = [];

    protected $casts = [
        'extra' => 'array',
        'favorite' => 'boolean',
    ];

    public function hentai()
    {
        return $this->hasMany(Hentai::class);
    }
}
