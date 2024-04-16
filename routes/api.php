<?php

use App\Http\Controllers\ToDoController;
use App\Http\Controllers\ToDoDetailController;
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
    // ToDoリスト一覧取得API（サンプルなので削除予定）
    Route::resource('toDos', ToDoController::class);
    // ToDoリストの詳細情報取得API（サンプルなので削除予定）
    Route::resource('toDoDetails', ToDoDetailController::class);
    // 投稿情報の取得API（30件取得）＋投稿の返信コメントも紐づけ
    Route::resource('post', PostsController::class);
    // 自分のユーザー情報取得API
    Route::get('profile', [ProfilesController::class, 'getProfile']);
    // 外部アカウントからの情報取得API
    Route::get('profile/{accountId}', [ProfilesController::class, 'getExternalProfile']);
});