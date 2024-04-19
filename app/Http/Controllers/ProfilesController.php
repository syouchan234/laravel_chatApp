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
        $profile = $user->profile ?? null;
        
        return response()->json([
            'name' => $user->name,
            'account_name' => $user->account_name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $profile ? $profile->updated_at : $user->created_at,
            'gender' => $profile ? $profile->gender : null,
            'place' => $profile ? $profile->place : null,
            'birthday' => $profile ? $profile->birthday : null,
            'introduction' => $profile ? $profile->introduction : null,
        ]);
    }

    public function getExternalProfile($accountId)
    {
        $account = Account::findOrFail($accountId); // 外部アカウントからのアカウントIDでアカウント情報を取得
        $posts = Post::where('account_id', $accountId)->get(); // 外部アカウントからのユーザーが投稿した全ての投稿データを取得
        $profile = $account->profile ?? null;

        return response()->json([
            'account_name' => $account->account_name,
            'created_at' => $account->created_at,
            'updated_at' => $profile? $profile->updated_at : $account->created_at,
            'gender' => $profile ? $profile->gender : null,
            'place' => $profile ? $profile->place : null,
            'birthday' => $profile ? $profile->birthday : null,
            'introduction' => $profile ? $profile->introduction : null,
            'posts' => $posts
        ]);
    }
}
