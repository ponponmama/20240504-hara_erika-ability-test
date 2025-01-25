@extends('layouts.app_contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection


@section('heading__link')
<div class="header__button">
    <a href="/login">
        <button class="header-nav__button">
            login
        </button>
    </a>
</div>
@endsection

@section('content')
<h2 class="page-logo">
    register
</h2>
<div class="page-section">
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form-group">
            <div class="form-group-title">
                <span class="form-label-item">
                    お名前
                </span>
            </div>
            <div class="form-group-content">
                <div class="form-input-text">
                    <input class="contact-item" type="text" name="name" placeholder="例）山田&ensp;太郎" value="{{ old('name') }}" >
                    </div>
                    <div class="form-error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-title">
                    <span class="form-label-item">
                        メールアドレス
                    </span>
                </div>
                <div class="form-group-content">
                    <div class="form-input-text">
                        <input class="contact-item" type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" >
                    </div>
                    <div class="form-error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-title">
                    <span class="form-label-item">
                        パスワード
                    </span>
                </div>
                <div class="form-group-content">
                    <div class="form-input-text">
                        <input class="contact-item"  type="password" name="password" placeholder="coachtech1106" >
                    </div>
                    <div class="form-error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-button">
                    <button class="form-button-submit1" type="submit">
                        登録
                    </button>
                </div>
        </form>
    </div>
</div>
@endsection
