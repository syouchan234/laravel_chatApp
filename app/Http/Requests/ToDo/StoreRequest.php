<?php

/**
 * このコードはサンプルコードです
 * 他の実装が終わり次第削除します。
 */

namespace App\Http\Requests\ToDo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
/**
 * このコードはサンプルコードです
 * 他の実装が終わり次第削除します。
 */

    //バリデーションルールの実装
    public function rules(): array
    {
        return [
            'title' => 'required|string'
        ];
    }
}
