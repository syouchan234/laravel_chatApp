<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('createUser', [AuthController::class, 'createUser']);
// ログイン中でないと操作できないAPI
Route::group(['middleware' => ['auth:sanctum']], function () {
    // 名前とメールアドレスを返却するAPI
    Route::get('user', [AuthController::class, 'user']);
    // ログアウトAPI
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // ユーザーの削除API
    Route::delete('deleteUser', [AuthController::class, 'deleteUser']);
    // 投稿関連
    Route::resource('post', PostsController::class);
    // コメント
    Route::resource('comments', CommentsController::class);
    // 自分のユーザー情報取得API
    Route::get('profile', [ProfilesController::class, 'getProfile']);
    // 自分のユーザー情報の更新API
    Route::post('profile', [ProfilesController::class, 'updateProfile']);
    // 外部アカウントからの情報取得API
    Route::get('profile/{accountId}', [ProfilesController::class, 'getExternalProfile']);
});