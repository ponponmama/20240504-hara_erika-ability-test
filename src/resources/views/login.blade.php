@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('heading__link')
    <a class="header-nav-link" href="/register">
        register
    </a>
@endsection

@section('content')
    <h2 class="page-logo">
        Login
    </h2>
    <div class="page-section">
        <form class="page-main-form" action="/login" method="post">
            @csrf
            <div class="form-group email-group">
                <label class="form-label-item form-label--item" for="email">
                    メールアドレス
                </label>
                <input class="contact-item" type="email" id="email" name="email" placeholder="例:&nbsp;test@example.com" value="{{ old('email') }}" autocomplete="email">
            </div>
            <p class="form-error">
                @error('email')
                    {{ $message }}
                @enderror
            </p>
            <div class="form-group">
                <label class="form-label-item" for="password">
                    パスワード
                </label>
                <input class="contact-item" type="password" id="password"  name="password" placeholder="例:&nbsp;coachtech1106" autocomplete="current-password">
            </div>
            <p class="form-error">
                @error('password')
                    {{ $message }}
                @enderror
            </p>
            <button class="button login-button" type="submit">
                ログイン
            </button>
        </form>
    </div>
@endsection
