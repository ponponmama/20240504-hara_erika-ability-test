@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection


@section('heading__link')
    <a class="link header-nav-link" href="/login">
        login
    </a>
@endsection

@section('content')
    <h2 class="page-logo">
        Register
    </h2>
    <div class="page-section">
        <form class="page-main-form" action="/register" method="post">
            @csrf
            <div class="form-group name-group">
                <label class="form-label-item name-label" for="name">
                    お名前
                </label>
                <input class="contact-item" type="text" id="name" name="name" placeholder="例:&ensp;山田&ensp;太郎"
                    value="{{ old('name') }}" autocomplete="name">
                <p class="form-error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form-group">
                <label class="form-label-item" for="email">
                    メールアドレス
                </label>
                <input class="contact-item" type="email" id="email" name="email" placeholder="例:&nbsp;test@example.com"
                    value="{{ old('email') }}" autocomplete="email">
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
                <input class="contact-item" type="password" id="password" name="password"
                    placeholder="例:&nbsp;coachtech1106" autocomplete="new-password">
                <p class="form-error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <button class="button register-button" type="submit">
                登録
            </button>
        </form>
    </div>
@endsection
