<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    // このメソッドは、Comment モデルが Post モデルに属する関係を定義します。
    // つまり、1つのコメントは特定の投稿に属します。
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
