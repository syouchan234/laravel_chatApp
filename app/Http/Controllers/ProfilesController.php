<?php

namespace App\Http\Controllers;
use App\Models\Account;
use App\Models\Post;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function getProfile(Request $request)
    {
        $user = $request->user(); // ログイン中のユーザー情報を取得

        return response()->json([
            'accounts' => $user
        ]);
    }

    public function getExternalProfile($accountId)
    {
        $account = Account::findOrFail($accountId); // 外部アカウントからのアカウントIDでアカウント情報を取得
        $posts = Post::where('account_id', $accountId)->get(); // 外部アカウントからのユーザーが投稿した全ての投稿データを取得

        return response()->json([
            'account' => $account,
            'posts' => $posts
        ]);
    }
}
