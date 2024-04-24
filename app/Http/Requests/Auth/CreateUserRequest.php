<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'account_name' => 'required|string|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ];
    }
}
