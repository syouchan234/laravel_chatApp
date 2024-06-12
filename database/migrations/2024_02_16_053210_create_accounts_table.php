<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * アカウントを管理するテーブル
 */
return new class extends Migration
{
    public function up(): void
    {
        // accounts テーブルを作成する
        Schema::create('accounts', function (Blueprint $table) {
            // IDカラムを作成する（Primary Key）
            $table->id();
            // ユーザーのフルネームを格納するカラム
            $table->string('name');
            // ユーザーのアカウント名を格納するカラム（ユニーク制約）
            $table->string('account_name')->unique();
            // ユーザーのメールアドレスを格納するカラム（ユニーク制約）
            $table->string('email')->unique();
            // メール認証が行われた日時を格納するカラム（任意、NULL許容）
            $table->timestamp('email_verified_at')->nullable();
            // パスワードを格納するカラム
            $table->string('password');
            // レコードの作成日時と更新日時を管理するためのタイムスタンプカラム
            $table->timestamps();
            // 論理削除用のカラム
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
