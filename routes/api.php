<?php

use App\Http\Controllers\ToDoController;
use App\Http\Controllers\ToDoDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//詳細はphp artisan route:list又はlocalhost/api/{指定したURI}で確認できる

//関数を指定して実行。
// Route::get('toDos' , [ToDoController::class , 'index']);

//記述されている関数ごとにURLが発行される。


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/createUser', [AuthController::class, 'createUser']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('toDos' , ToDoController::class);
    Route::resource('toDoDetails' , ToDoDetailController::class);
});
