<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;


class PostsController extends Controller
{
    public function index()
    {
        // 最新の投稿一覧を取得し、関連するアカウント情報とコメントを取得する
        // 論理削除された投稿およびコメントを除外する
        $posts = Post::with(['account', 'comments' => function ($query) {
            $query->whereNull('deleted_at')->take(10); // コメントを最大10件まで取得する
        }])->whereNull('deleted_at')->latest()->take(30)->get();

        // 必要な情報だけを整形して返す
        $formattedPosts = $posts->map(function ($post) {
            return [
                'id' => $post->id,
                'content' => $post->content,
                'account_id' => $post->account->id,
                'account_name' => $post->account->account_name,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'comments' => $post->comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'content' => $comment->content,
                        'account_id' => $comment->account_id,
                        'account_name' => $comment->account->account_name, // コメントに関連するアカウント名を取得
                        'created_at' => $comment->created_at,
                        'updated_at' => $comment->updated_at,
                    ];
                }),
            ];
        });

        // 取得した投稿一覧を返す
        return response()->json($formattedPosts);
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
