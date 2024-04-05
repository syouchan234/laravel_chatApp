<?php

/**
 * このコードはサンプルコードです
 * 他の実装が終わり次第削除します。
 */

namespace App\Http\Requests\ToDoDetail;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'to_do_id' => 'required|exists:to_dos,id',
            'name' => 'required|string'
        ];
    }
}
