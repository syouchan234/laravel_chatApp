<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    //バリデーションルールの制定
    public function rules(): array
    {
        return [
            'content' => 'required|string|max:500',
        ];
    }
}
