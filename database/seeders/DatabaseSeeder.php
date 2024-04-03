<?php

namespace Database\Seeders;

use App\Models\ToDo;
use App\Models\ToDoDetail;
use App\Models\Account;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // ToDo情報のサンプルデータの作成
        $todo = ToDo::factory()->create();
        ToDoDetail::factory(5)->create([
            'to_do_id' => $todo->id
        ]);

        // // サンプルアカウントデータの作成
        // Account::create([
        //     'name' => 'testuser',
        //     'account_name' => 'testerMAN',
        //     'email' => 'test@examle.com',
        //     'password' => Hash::make('password'),
        // ]);

        // サンプルアカウントデータの作成
        Account::factory(5)->create();

        // データを挿入する処理
        Post::factory()->count(10)->create();
    }
}
