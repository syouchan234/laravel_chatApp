<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // commentsテーブルを作成する
        Schema::create('comments', function (Blueprint $table) {
            // IDカラムを作成する（Primary Key）
            $table->id();
            // 投稿への返信の場合、親コメントのIDを格納するカラム（任意、NULL許容）
            $table->unsignedBigInteger('parent_id')->nullable();
            // ユーザーのIDを格納するカラム（外部キー）
            $table->unsignedBigInteger('user_id');
            // usersテーブルのidカラムを参照する
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // 投稿への返信の場合、commentsテーブルのidカラムを参照する
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            // 投稿のIDを格納するカラム（外部キー）
            $table->unsignedBigInteger('post_id');
            // postsテーブルのidカラムを参照する
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            // コメントの内容を格納するカラム
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
        // commentsテーブルが存在する場合は削除する
        Schema::dropIfExists('comments');
    }
};
