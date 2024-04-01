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
        // profilesテーブルを作成する
        Schema::create('profiles', function (Blueprint $table) {
            // IDカラムを作成する（Primary Key）
            $table->id();
            // アカウントのIDを格納するカラム（外部キー）
            $table->unsignedBigInteger('account_id');
            // accountsテーブルのidカラムを参照し、削除時に関連するレコードをcascadeで削除する
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            // ユーザーの名字を格納するカラム（任意、NULL許容）
            $table->string('first_name')->nullable();
            // ユーザーの苗字を格納するカラム（任意、NULL許容）
            $table->string('last_name')->nullable();
            // ユーザーの性別を格納するカラム（任意、NULL許容）
            $table->string('gender')->nullable();
            // ユーザーの誕生日を格納するカラム（任意、NULL許容）
            $table->date('birthday')->nullable();
            // ユーザーの自己紹介文を格納するカラム（任意、NULL許容）
            $table->text('bio')->nullable();
            // レコードの作成日時と更新日時を管理するためのタイムスタンプカラム
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // profilesテーブルが存在する場合は削除する
        Schema::dropIfExists('profiles');
    }
};
