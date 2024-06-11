<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use HasFactory, SoftDeletes;  // SoftDeletes トレイトを追加

    // リレーションシップ: 投稿
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // リレーションシップ: アカウント
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
