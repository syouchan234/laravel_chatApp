<?php

namespace App\Http\Requests\ToDo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    //認証が通っているか確認する関数
    // public function authorize(): bool
    // {
    //     return false;
    // }

    //バリデーションルールの実装
    public function rules(): array
    {
        return [
            'title' => 'required|string'
        ];
    }
}
