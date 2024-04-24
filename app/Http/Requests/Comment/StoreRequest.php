<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    //バリデーションルールの制定
    public function rules(): array
    {
        return [
            'content' => 'required|string|max:255', // コメント内容は必須で、文字列で最大255文字まで許容
            'post_id' => 'required|exists:posts,id', // 投稿IDは必須で、postsテーブルのidに存在することを確認
            'parent_id' => 'nullable|exists:comments,id', // 親コメントIDは任意で、commentsテーブルのidに存在することを確認
        ];
    }
}
