<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Comment\StoreRequest;
use App\Models\Post;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function index()
    {
        // コメント一覧を取得し、関連するアカウント情報も一括で取得する
        $comments = Comments::with('account')->get();

        // 必要な情報だけを整形して返す
        $commentList = $comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'content' => $comment->content,
                'account_id' => $comment->account_id,
                'account_name' => $comment->account->name, // アカウント名を取得
                'created_at' => $comment->created_at,
                'updated_at' => $comment->updated_at,
            ];
        });

        // 取得したコメント一覧を返す
        return response()->json($commentList);
    }
    
    public function store(StoreRequest $request)
    {
        // リクエストから投稿IDを取得
        $postId = $request->input('post_id');

        // 対象の投稿を取得（存在しない場合は404エラーを返す）
        $post = Post::findOrFail($postId);

        // 新しいコメントインスタンスを作成
        $comment = new Comments();
        $comment->content = $request->input('content');
        $comment->post_id = $post->id;
        $comment->account_id = auth()->id(); // ログインユーザーのIDを取得
        $comment->save();

        // 投稿が成功した場合、新しいコメント情報を含むレスポンスを返す
        return response()->json(['message' => 'コメントが投稿されました', 'comment' => $comment], 201);
    }
}