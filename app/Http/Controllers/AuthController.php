<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Account;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = Auth::user()->createToken('AccessToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
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

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'ログアウトしました。'], 200);
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'account_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $account = Account::create([
            'name' => $request->name,
            'account_name' => $request->account_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // $token = Auth::user()->createToken('AccessToken')->plainTextToken;

        // return response()->json(['token' => $token, 'message' => 'アカウントを作成しました'], 201);
        return response()->json(['message' => 'アカウントを作成しました'], 201);
    }
}
