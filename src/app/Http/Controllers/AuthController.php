<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;



    class AuthController extends Controller
    {
        public function register(RegisterRequest $request) {

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $user->save();
            return redirect()->route('login');
        }

        public function login(LoginRequest $request)
        {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // 認証に成功した場合、ユーザーを登録ページにリダイレクト
                return redirect()->intended('admin');
            } else {
                // 認証に失敗した場合、ログインページにリダイレクトし、エラーメッセージを表示
                return redirect()->route('login')->withErrors([
                    'error' => 'メールアドレスまたはパスワードが間違っています。'
                ]);
            }
        }

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }


    }