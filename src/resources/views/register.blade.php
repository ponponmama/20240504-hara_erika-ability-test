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
        <div class="form-group form-group-name">
            <p class="form-label-item">
                お名前
            </p>
            <input class="contact-item" type="text" name="name" placeholder="例）山田&ensp;太郎" value="{{ old('name') }}" >
            <p class="form-error">
                @error('name')
                    {{ $message }}
                @enderror
            </p>
        </div>
        <div class="form-group">
            <p class="form-label-item">
                メールアドレス
            </p>
            <input class="contact-item" type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" >
            <p class="form-error">
                @error('email')
                    {{ $message }}
                @enderror
            </p>
        </div>
        <div class="form-group">
            <p class="form-label-item">
                パスワード
            </p>
            <input class="contact-item"  type="password" name="password" placeholder="coachtech1106" >
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
