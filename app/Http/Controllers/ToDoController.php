<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDo\StoreRequest;
use App\Http\Requests\ToDo\UpdateRequest;
use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ToDoを取得する処理
        $toDoList = ToDo::get();
        //取得したToDoを返す
        return $toDoList;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //新規のToDoモデルを作成する
        $todo = new ToDo();
        //タイトルをToDoモデルに設定する
        $todo->title = $request->get('title');
        //DBにデータを登録する
        $todo->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        //IDに紐づくToDoモデルの取得
        $todo = ToDo::find($id);//$idに一致する情報を取得している
        //タイトルをToDoモデルに設定する
        $todo->title = $request->get('title');
        //DBにデータを更新する
        $todo->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    //本来削除は削除フラグを利用するので
    public function destroy($id)
    {
        //IDに紐づくToDoモデルの取得
        $todo = ToDo::find($id);//$idに一致する情報を取得している
        //DBにデータを更新する
        $todo->delete();
    }
}
