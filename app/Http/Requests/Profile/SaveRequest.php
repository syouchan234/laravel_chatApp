<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_name' => 'required|string|max:30',
            'gender' => 'nullable|string',
            'place' => 'nullable|string|max:100',
            'birthday' => 'nullable|string',
            'introduction' => 'nullable|string|max:300'
        ];
    }
}
