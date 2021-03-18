<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagCreateUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:255',
                Rule::unique('tags')->ignore($this->id)
            ],
            'count' => 'integer',
            'note' => 'min:2|nullable',
            'favorite' => 'boolean'
        ];
    }
}
