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
                return redirect()->intended('admin');
            } else {
                return redirect()->route('login');
            }
        }

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        }

        public function showLoginForm(Request $request)
        {
            // ユーザーが既にログインしている場合は、セッションを無効化してログインページを表示
            if (Auth::check()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return view('login');
        }
    }