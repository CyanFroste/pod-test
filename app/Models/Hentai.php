<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hentai extends Model
{
    use HasFactory;

    protected $table = 'hentai';

    protected $guarded = [];

    protected $casts = [
        'extra' => 'array',
        'anime' => 'boolean',
        'doujin' => 'boolean',
        '3d' => 'boolean',
        'favorite' => 'boolean',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'hentai_tag');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
