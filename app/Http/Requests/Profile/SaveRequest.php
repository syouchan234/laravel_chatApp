<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_id' => 'required|exists:accounts,id', // ユーザーIDは必須で、accountsテーブルのidに存在することを確認
            'gender' => 'required|string',
            'place' => 'required|string|max:100',
            'birthday' => 'required|date',
            'introduction' => 'required|string|max:300'
        ];
    }
}
