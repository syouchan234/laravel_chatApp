<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;

// ログインAPI
Route::post('login', [AuthController::class, 'login'])->name('login');
// アカウント作成API
Route::post('createUser', [AuthController::class, 'createUser']);
// ログイン中でないと操作できないAPI
Route::group(['middleware' => ['auth:sanctum']], function () {
    // 名前とメールアドレスを返却するAPI
    Route::get('user', [AuthController::class, 'user']);
    // ログアウトAPI
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // 投稿関連
    Route::resource('post', PostsController::class);
    // 自分のユーザー情報取得API
    Route::get('profile', [ProfilesController::class, 'getProfile']);
    // 外部アカウントからの情報取得API
    Route::get('profile/{accountId}', [ProfilesController::class, 'getExternalProfile']);
});