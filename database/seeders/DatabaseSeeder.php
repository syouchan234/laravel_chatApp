<?php

namespace Database\Seeders;

use App\Models\ToDo;
use App\Models\ToDoDetail;
use App\Models\Account;
use App\Models\Comments;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // // ToDo情報のサンプルデータの作成
        // $todo = ToDo::factory()->create();
        // ToDoDetail::factory(5)->create([
        //     'to_do_id' => $todo->id
        // ]);
        
        // サンプルアカウントデータの作成
        // Account::factory()->create();

        // サンプルアカウントデータの作成
        Account::create([
            'name' => 'testuser',
            'account_name' => 'testerMAN',
            'email' => 'test@examle.com',
            'password' => Hash::make('password'),
        ]);

        // // サンプル投稿データの作成
        // $posts = Post::factory()->count(5)->create();

        // サンプルコメントデータの作成
        // foreach ($posts as $post) {
        //     Comments::factory(5)->create([
        //         'post_id' => $post->id
        //     ]);
        // }
        
        // Account::factory()->create();//アカウントデータのみが作成される
        // Post::factory()->create();//postデータとaccountデータが同時に作成れる。
        // Comments::factory()->create();//commentデータとpostデータとaccountデータが同時に作成れる。
    }
}
