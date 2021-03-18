<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArtistCreateUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('artists')->ignore($this->id)
            ],
            'note' => 'min:2|nullable',
            'extra' => 'array|nullable',
            'favorite' => 'boolean'
        ];
    }
}
