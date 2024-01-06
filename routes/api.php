<?php

use App\Http\Controllers\ToDoController;
use App\Http\Controllers\ToDoDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//詳細はphp artisan route:list又はlocalhost/api/{指定したURI}で確認できる

//関数を指定して実行。
// Route::get('toDos' , [ToDoController::class , 'index']);

//記述されている関数ごとにURLが発行される。
Route::resource('toDos' , ToDoController::class);
Route::resource('toDoDetails' , ToDoDetailController::class);