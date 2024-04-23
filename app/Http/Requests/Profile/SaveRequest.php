<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'gender' => 'string',
            'place' => 'string|max:100',
            'birthday' => 'nullable|string',
            'introduction' => 'string|max:300'
        ];
    }
}
