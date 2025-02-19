<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //返信コメントの紐づけ
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    // アカウントとのリレーションを定義
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function delete()
    {
        //投稿に関連するCommentsの削除
        $this->comments()->delete();

        //投稿の削除
        return parent::delete();
    }
}
