<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    //バリデーションルールの制定
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:500',
            'account_id' => 'required|exists:accounts,id'
        ];
    }
}
