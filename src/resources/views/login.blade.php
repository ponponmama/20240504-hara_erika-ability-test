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
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="alert-error">
        @if ($errors->has('miss-error'))
            <li>{{ $errors->first('miss-error') }}</li>
        @endif
    </ul>
</div>
@endif
<div class="page-section">
    <form class="page-main-form" action="/login" method="post">
        @csrf
        <div class="form-group">
            <div class="form-group-title">
                <span class="form-label--item">
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
                    <input class="contact-item" type="password" name="password" placeholder="coachtech1106" >
                </div>
                <div class="form-error">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <button class="form-button-submit login-btn" type="submit">
            ログイン
        </button>
    </form>
</div>
@endsection
