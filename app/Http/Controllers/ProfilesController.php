<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\SaveRequest;
use App\Models\Account;
use App\Models\Post;
use App\Models\Profiles;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    // 自分のアカウントの情報を取得
    public function getProfile(Request $request)
    {
        $user = $request->user(); // ログイン中のユーザー情報を取得
        $posts = Post::where('account_id', $user->id)->get();

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
            'posts' => $posts
        ]);
    }

    // 自分のアカウントの情報を更新
    public function updateProfile(SaveRequest $request){
        $user = $request->user(); // ログイン中のユーザー情報を取得

        // ユーザーのプロフィールを取得または新規作成
        $profile = $user->profile ?? new Profiles();
    
        // ユーザーのアカウント情報を更新
        $user->account_name = $request->input('account_name');
        $user->save();
    
        // プロフィール情報を更新
        $profile->gender = $request->input('gender');
        $profile->place = $request->input('place');
        $profile->birthday = $request->input('birthday');
        $profile->introduction = $request->input('introduction');
    
        // ユーザーとプロフィールを関連付ける
        $user->profile()->save($profile);
    
        return response()->json(['message' => 'success']);
    }

    // 他人のアカウントの情報を取得
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
