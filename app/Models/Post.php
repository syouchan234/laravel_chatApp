<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;  // SoftDeletes トレイトを追加

    // リレーションシップ: コメント
    public function comments()
    {
        return $this->hasMany(Comments::class);  // Comments ではなく Comment が正しい
    }

    // リレーションシップ: アカウント
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
