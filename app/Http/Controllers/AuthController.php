<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

use App\Http\Requests\Auth\CreateUserRequest;
// use App\Http\Requests\Auth\UpdateUserRequest;
use App\Models\Account;

class AuthController extends Controller
{
    /**
     * ログイン用API関数
     * @return token
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); // ログインユーザーを取得
            $token = $user->createToken('AccessToken')->plainTextToken;
            
            // トークンをCookieに保存
            $cookie = Cookie::make('token', $token, 60 * 24 * 30, '/', null, false, true); // 有効期限30日、secure属性有効、HTTP only
            
            // ログインユーザーの情報とトークンを返す
            return response()->json(['token' => $token, 'user' => $user])->withCookie($cookie);
        } else {
            return response()->json(['error' => '認証に失敗しました。'], 401);
        }
    }
    
    public function user(Request $request){
        return response()->json(
            [
                $request->user()->name,
                $request->user()->email,
            ]
        );
    }

    /**
     * ログアウト用API関数
     * トークンを受けて一致するアクセストークンを削除する
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'ログアウトしました。'], 200);
    }

    /**
     * アカウント作成用API関数
     * @return token,message
     */
    public function createUser(CreateUserRequest $request)
    {
        $user = Account::create([
            'name' => $request->name,
            'account_name' => $request->account_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // ユーザーが作成された後にトークンを生成
        $token = $user->createToken('AccessToken')->plainTextToken;
    
        // トークンをCookieに保存
        $cookie = Cookie::make('token', $token, 60 * 24 * 30, '/', null, false, true); // 有効期限30日、secure属性有効、HTTP only
    
        return response()->json(['token' => $token, 'message' => 'アカウントを作成しました'], 201)->withCookie($cookie);
    }
}
