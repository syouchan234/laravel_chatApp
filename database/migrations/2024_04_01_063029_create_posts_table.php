<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // postsテーブルを作成する
        Schema::create('posts', function (Blueprint $table) {
            // IDカラムを作成する（Primary Key）
            $table->id();
            // ユーザーのIDを格納するカラム（外部キー）
            $table->unsignedBigInteger('account_id');
            // usersテーブルのidカラムを参照する
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            // 投稿の内容を格納するカラム
            $table->text('content');
            // レコードの作成日時と更新日時を管理するためのタイムスタンプカラム
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // postsテーブルが存在する場合は削除する
        Schema::dropIfExists('posts');
    }
}
