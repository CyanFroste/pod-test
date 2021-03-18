<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HentaiCreateUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [

            'name' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('hentai')->ignore($this->id),
            ],
            'code' => [
                'min:2',
                'max:255',
                Rule::unique('hentai')->ignore($this->id),
                'nullable'
            ],

            'language' => 'min:2|max:255',
            'origin' => 'min:2|max:255',

            'anime' => 'boolean',
            'doujin' => 'boolean',
            '3d' => 'boolean',

            'note' => 'min:2|nullable',
            'extra' => 'array|nullable',
            'favorite' => 'boolean',

            'artist_id' => 'integer|exists:artists,id|nullable',
            'studio_id' => 'integer|exists:studios,id|nullable'
        ];
    }
}
