<?php

namespace App\Http\Requests\ToDo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return false;
    // }
    public function rules(): array
    {
        return [
            'title' => 'required|string'
        ];
    }
}
