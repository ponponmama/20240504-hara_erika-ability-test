@extends('layouts.app_contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<h2 class="page-logo">
    Contact
</h2>
<div class="page-section">
    <form class="contact-form" action="/contacts/confirm" method="post">
        @csrf
            @php
                $contact = session('contact');
            @endphp
            <div class="form-group">
                <div class="form-group-title">
                    <span class="form-label-item">
                        お名前
                    </span>
                    <span class="form-label-required">
                            ※
                    </span>
                </div>
                <div class="form-group-content">
                    <div class="name-input-text">
                        <input class="contact-item-name" type="text" name="first_name" placeholder="例）山田" value="{{ old('first_name') }}" >
                        <input class="contact-item-name" type="text" name="last_name" placeholder="例）太郎" value="{{ old('last_name') }}" >
                    </div>
                    <div class="form-error">
                        @if($errors->has('first_name'))
                            {{ $errors->first('first_name') }}
                        @endif
                        @if($errors->has('last_name'))
                            {{ $errors->first('last_name') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-title">
                    <span class="form-label--item">
                        性別
                    </span>
                    <span class="form-label-required">
                        ※
                    </span>
                </div>
                <div class="form-group-content">
                    <div class="form-input-radio">
                        <input id="gender-radio1" class="gender-radio" type="radio" name="gender" value="1" {{ old('gender')=='1' ? 'checked' : '' }} >
                        <label class="gender-radio-label" for="gender-radio1">男性</label>
                        <input id="gender-radio2" class="gender-radio" type="radio" name="gender" value="2" {{ old('gender')=='2' ? 'checked' : '' }} >
                        <label class="gender-radio-label" for="gender-radio2">女性</label>
                        <input id="gender-radio3" class="gender-radio" type="radio" name="gender" value="3" {{ old('gender')=='3' ? 'checked' : '' }} >
                        <label class="gender-radio-label" for="gender-radio3">その他</label>
                    </div>
                    <div class="form-error">
                        @error('gender')
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
                    <span class="form-label-required">
                        ※
                    </span>
                </div>
                <div class="form-group-content">
                    <div class="form-input-text">
                        <input class="contact-item" type="email" name="email" value="{{ $contact['email'] ?? old('email')}}" placeholder="test@example.com" >
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
                        電話番号
                    </span>
                    <span class="form-label-required">
                        ※
                    </span>
                </div>
                <div class="form-group-content">
                    <div class="form-input-tell">
                        <input class="contact-item-tell" type="tel" name="tell1" value="{{ $contact['tell1'] ?? old('tell1') }}" placeholder="090" >
                        <span class="tel">-</span>
                        <input class="contact-item-tell" type="tel" name="tell2" value="{{ $contact['tell2'] ?? old('tell2') }}" placeholder="1234" >
                        <span class="tel">-</span>
                        <input class="contact-item-tell" type="tel" name="tell3" value="{{ $contact['tell3'] ?? old('tell3') }}" placeholder="5678" >
                    </div>
                    <div class="form-error">
                        @if ($errors->has('tell1'))
                            {{ $errors->first('tell1') }}
                        @elseif ($errors->has('tell2'))
                            {{ $errors->first('tell2') }}
                        @elseif ($errors->has('tell3'))
                            {{ $errors->first('tell3') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-title">
                    <span class="form-label-item">
                        住所
                    </span>
                    <span class="form-label-required">
                        ※
                    </span>
                </div>
                <div class="form-group-content">
                    <div class="form-input-text">
                        <input class="contact-item" type="text" name="address" value="{{ $contact['address'] ?? old('address')}}" placeholder="東京都渋谷区千駄ヶ谷1-2-3" >
                    </div>
                    <div class="form-error">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-title">
                    <span class="form-label-item">
                        建物名
                    </span>
                </div>
                <div class="form-group-content">
                    <div class="form-input-text">
                        <input  class="contact-item" type="text" name="building" value="{{ $contact['building'] ?? old('building')}}" placeholder="千駄ヶ谷マンション101" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-title">
                    <span class="form-label-item">
                        お問い合わせの種類
                    </span>
                    <span class="form-label-required">
                        ※
                    </span>
                </div>
                <div class="form-group-content-select">
                    <select class="create-form-item-select" name="category_id">
                        <option class="form-select" value="{{old('category_id')}}">
                            選択してください
                        </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $contact && $contact['category_id'] == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-error">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group-detail">
                    <div class="form-group-title">
                        <span class="form-label-item">
                            お問い合わせ内容
                        </span>
                        <span class="form-label-required">
                            ※
                        </span>
                    </div>
                    <div class="form-group-content-detail">
                        <textarea class="contact-item-detail" name="detail" placeholder="お問い合わせの内容をご記載ください">
                            {{ $contact['detail'] ?? old('detail')}}
                        </textarea>
                        <div class="form-error">
                            @error('detail')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-button">
                    <button class="form-button-submit" type="submit">
                        確認画面
                    </button>
                </div>
    </form>
</div>
@endsection
