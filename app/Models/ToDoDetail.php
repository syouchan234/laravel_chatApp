<?php

/**
 * このコードはサンプルコードです
 * 他の実装が終わり次第削除します。
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoDetail extends Model
{
    use HasFactory;

    public function toDo(){
        return $this->belongsTo(ToDo::class);
    }
}
