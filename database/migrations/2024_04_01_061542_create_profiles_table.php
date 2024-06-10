<?php
namespace App\Http\Controllers;
use App\Http\Requests\Profile\SaveRequest;
use App\Models\Account;
use App\Models\Comments;
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
            'isOwnProfile' => true,
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
    public function updateProfile(SaveRequest $request)
    {
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
            'isOwnProfile' => false,
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

    // ユーザーのアカウントと関連する投稿を論理削除
    public function deleteUser(Request $request)
    {
        $user = $request->user(); // ログイン中のユーザー情報を取得

        // ユーザーが投稿した全てのコメント（リプライ）を取得し、論理削除
        $comments = Comments::where('account_id', $user->id)->get();
        foreach ($comments as $comment) {
            $comment->delete();
        }

        // ユーザーの投稿を取得し、論理削除
        $posts = Post::where('account_id', $user->id)->get();
        foreach ($posts as $post) {
            $post->delete();
        }

        // ユーザーを論理削除
        $user->delete();
        return response()->json(['message' => 'User and associated posts have been soft deleted.']);
    }
}
