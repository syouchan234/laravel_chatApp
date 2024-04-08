<?php

/**
 * このコードはサンプルコードです
 * 他の実装が終わり次第削除します。
 */

namespace App\Http\Requests\ToDo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
/**
 * このコードはサンプルコードです
 * 他の実装が終わり次第削除します。
 */
    public function rules(): array
    {
        return [
            'title' => 'required|string'
        ];
    }
}
