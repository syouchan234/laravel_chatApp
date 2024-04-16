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
                'account_name' => $post->account->name, // アカウントの名前を取得
                'content' => $post->content,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'comments' => $post->comments // ここでコメントも取得する必要があれば加工する
            ];
        });

        // 取得した投稿一覧を返す
        return $postList;
    }

    //投稿する処理
    public function store(StoreRequest $request)
    {
        //新規のpostモデルを作成する
        $post = new Post();
        //各情報をモデルに設定する
        $account_id = auth()->id();
        $post->content = $request->get('content',$account_id);
        
        //DBに登録する
        $post->save();
    }
}
