<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'account_id',
        'gender',
        'place',
        'birthday',
        'introduction',
    ];

    // アカウントとのリレーションを定義
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
