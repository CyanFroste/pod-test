<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StarCreateUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('stars')->ignore($this->id)
            ],
            'ethnicity' => 'min:2|max:255|nullable',
            'image' => 'min:2|nullable',
            'note' => 'min:2|nullable',
            'extra' => 'array|nullable',
            'favorite' => 'boolean'
        ];
    }
}
