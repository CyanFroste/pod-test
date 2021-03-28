<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovieCreateUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => [
                'min:2',
                'max:255',
                Rule::unique('movies')->ignore($this->id),
                'nullable',
            ],
            'name' => [
                'min:2',
                'max:255',
                Rule::unique('movies')->ignore($this->id),
            ],
            'origin' => 'min:2|max:255|nullable',
            'note' => 'min:2|nullable',
            'extra' => 'array|nullable',
            'favorite' => 'boolean',
            'studio_id' => 'integer|exists:studios,id|nullable',
        ];
    }
}
