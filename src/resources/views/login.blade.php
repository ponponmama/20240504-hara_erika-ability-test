@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('heading__link')
<a class="header-nav-link" href="/register">
    register
</a>
</div>
@endsection

@section('content')
<h2 class="page-logo">
    Login
</h2>
<div class="page-section">
    <form class="page-main-form" action="/login" method="post">
        @csrf
        <div class="form-group">
            <label class="form-label-item form-label--item" for="email">
                メールアドレス
            </label>
            <input class="contact-item" type="email" id="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" >
            <p class="form-error">
                    @error('email')
                        {{ $message }}
                    @enderror
            </p>
        </div>
        <div class="form-group">
            <label class="form-label-item" for="password">
                パスワード
            </label>
            <input class="contact-item" type="password" id="password"  name="password" placeholder="coachtech1106" >
            <p class="form-error">
                @error('password')
                    {{ $message }}
                @enderror
            </p>
        </div>
        <button class="button login-btn login-button" type="submit">
            ログイン
        </button>
    </form>
</div>
@endsection
