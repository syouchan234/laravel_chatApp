<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //投稿一覧を取得する処理
    public function index(){
        //コメントと一緒に投稿を取得する
        // $postList = Post::with('comments')->get();
        // 一時的にpostのみに適用※コメントに不具合
        $postList = Post::get();
        //取得情報を返却する
        return $postList;
    }

    //投稿する処理
    public function store(StoreRequest $request){
        //新規のpostモデルを作成する
        $post = new Post();
        //各情報をモデルに設定する
        $post->title = $request->get('title','content','account_id');
        //DBに登録する
        $post->save();
    }
}
