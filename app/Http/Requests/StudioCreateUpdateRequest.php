<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudioCreateUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('studios')->ignore($this->id)
            ],
            'hentai' => 'boolean',
            'movie' => 'boolean',
            'note' => 'min:2|nullable',
            'extra' => 'array|nullable',
            'favorite' => 'boolean'
        ];
    }
}
