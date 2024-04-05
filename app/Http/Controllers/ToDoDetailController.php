<?php

/**
 * このコードはサンプルコードです
 * 他の実装が終わり次第削除します。
 */

namespace App\Http\Controllers;

use App\Http\Requests\ToDoDetail\StoreRequest;
use App\Http\Requests\ToDoDetail\UpdateRequest;
use App\Models\ToDoDetail;
use Illuminate\Http\Request;

class ToDoDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //新規のToDoDetailモデルを作成する
        $todo_detail = new ToDoDetail();

        //ToDoDetailに値に設定する
        $todo_detail->to_do_id = $request->get('to_do_id');
        $todo_detail->name = $request->get('name');
        $todo_detail->completed_flag = false;

        // // リクエストから値を取得してToDo詳細に設定する
        // $todo_detail->fill($request->all());

        //DBにデータを登録する
        $todo_detail->save();
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
        //IDに紐づくToDoDetailモデルの取得
        $todo_detail = ToDoDetail::find($id);//$idに一致する情報を取得している
        //タイトルをToDoDetailモデルに設定する
        $todo_detail->name = $request->get('name');
        //DBにデータを更新する
        $todo_detail->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //IDに紐づくToDoモデルの取得
        $todo_detail = ToDoDetail::find($id);//$idに一致する情報を取得している
        //DBにデータを更新する
        $todo_detail->delete();
    }
}
