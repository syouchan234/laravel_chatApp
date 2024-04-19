<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //投稿一覧を取得する処理
    public function index()
    {
        // 最新の投稿一覧を取得し、関連するアカウント情報も取得する
        $noFormattedPosts = Post::with(['account', 'comments'])->latest()->take(30)->get();

        // 必要な情報だけを返すように整形
        $postList = $noFormattedPosts->map(function ($post) {
            return [
                'id' => $post->id,
                'account_id' => $post->account->id,
                'account_name' => $post->account->name,
                'content' => $post->content,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'comments' => $post->comments
            ];
        });

        // 取得した投稿一覧を返す
        return $postList;
    }

    public function store(StoreRequest $request)
    {
        // 新規のpostモデルを作成する
        $post = new Post();

        // 各情報をモデルに設定する
        $post->content = $request->input('content'); // 投稿内容を設定
        $post->account_id = auth()->id(); // ログインユーザーのアカウントIDを設定
        // DBに登録する
        $post->save();

        // 成功時のレスポンスを返す
        return response()->json(['message' => '投稿が作成されました', 'post' => $post], 201);
    }
}
