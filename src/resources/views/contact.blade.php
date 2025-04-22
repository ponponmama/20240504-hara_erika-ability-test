@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<h2 class="page-logo">
    Contact
</h2>
<div class="page-section">
    <form class="page-main-form" action="/contact/confirm" method="post">
        @csrf
        @php
            $contact = session('contact');
        @endphp
        <div class="form-group name-group">
            <label class="form-label-item name-label" for="name">
                お名前
                <span class="form-label-required">
                    ※
                </span>
            </label>
            <div class="input-container">
                <input class="contact-item input-name" type="text" name="first_name" placeholder="例）山田" value="{{ old('first_name',$contact['first_name'] ?? null) }}" >
                <input class="contact-item input-name" type="text" name="last_name" placeholder="例）太郎" value="{{ old('last_name',$contact['last_name'] ?? null) }}" >
            </div>
        </div>
        <p class="form-error">
            @if($errors->has('first_name'))
                <span class="error-message">{{ $errors->first('first_name') }}</span>
            @endif
            @if($errors->has('last_name'))
                <span>{{ $errors->first('last_name') }}</span>
            @endif
        </p>
        <div class="form-group gender-group">
            <label class="form-label-item gender-label">
                性別
                <span class="form-label-required">
                    ※
                </span>
            </label>
            <div class="input-container">
                <label class="form-label-item gender-radio-label" for="male">
                    <input id="male" class="gender-radio" type="radio" name="gender" value="1" {{ old('gender', $contact['gender'] ??
                        null)==1 ? 'checked' : '' }}>
                    <span class="gender-text">
                        男性
                    </span>
                </label>
                <label class="form-label-item gender-radio-label" for="female">
                    <input id="female" class="gender-radio" type="radio" name="gender" value="2" {{ old('gender', $contact['gender'] ?? null)=='2' ? 'checked' : '' }} >
                    <span class="gender-text">
                        女性
                    </span>
                </label>
                <label class="form-label-item gender-radio-label" for="other">
                    <input id="other" class="gender-radio" type="radio" name="gender" value="3" {{ old('gender', $contact['gender'] ?? null)=='3' ? 'checked' : '' }} >
                    <span class="gender-text">
                        その他
                    </span>
                </label>
            </div>
        </div>
        <p class="form-error">
            @error('gender')
                {{ $message }}
            @enderror
        </p>
        <div class="form-group">
            <label class="form-label-item" for="email">
                メールアドレス
                <span class="form-label-required">
                    ※
                </span>
            </label>
            <input class="contact-item" id="email" type="email" name="email" value="{{ old('email', $contact['email'] ?? null)}}" placeholder="test@example.com" >
        </div>
        <p class="form-error">
            @error('email')
                {{ $message }}
            @enderror
        </p>
        <div class="form-group">
            <label class="form-label-item label-tell" for="tel">
                電話番号
                <span class="form-label-required">
                    ※
                </span>
            </label>
            <div class="input-container">
                <input class="contact-item input-tell" id="tel" type="tel" name="tell1" value="{{ old('tell1',$contact['tell1'] ?? null) }}" placeholder="090" >
                <span class="tel">-</span>
                <input class="contact-item input-tell" id="tel" type="tel" name="tell2" value="{{ old('tell2',$contact['tell2'] ?? null) }}" placeholder="1234" >
                <span class="tel">-</span>
                <input class="contact-item input-tell" id="tel" type="tel" name="tell3" value="{{ old('tell3',$contact['tell3'] ?? null) }}" placeholder="5678" >
            </div>
        </div>
        <p class="form-error">
            @if ($errors->has('tell1'))
                {{ $errors->first('tell1') }}
            @elseif ($errors->has('tell2'))
                {{ $errors->first('tell2') }}
            @elseif ($errors->has('tell3'))
                {{ $errors->first('tell3') }}
            @endif
        </p>
        <div class="form-group">
            <label class="form-label-item" for="address">
                住所
                <span class="form-label-required">
                    ※
                </span>
            </label>
            <input class="contact-item" id="address" type="text" name="address" value="{{ old('address',$contact['address'] ?? null)}}" placeholder="東京都渋谷区千駄ヶ谷1-2-3" >
        </div>
        <p class="form-error">
            @error('address')
                {{ $message }}
            @enderror
        </p>
        <div class="form-group">
            <label class="form-label-item" for="building">
                建物名
            </label>
            <input  class="contact-item" id="building" type="text" name="building" value="{{ old('building',$contact['building'] ?? null)}}" placeholder="千駄ヶ谷マンション101" >
        </div>
        <div class="form-group select-group">
            <label class="form-label-item">
                お問い合わせの種類
                <span class="form-label-required">
                    ※
                </span>
            </label>
            <select class="contact-item create-form-item-select" name="category_id">
                <option disabled selected>
                    選択してください
                </option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id',$contact['category_id'] ?? null)==$category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
        </div>
        <p class="form-error">
            @error('category_id')
                {{ $message }}
            @enderror
        </p>
        <div class="form-group">
            <label class="form-label-item" for="detail">
                お問い合わせ内容
                <span class="form-label-required">
                    ※
                </span>
            </label>
            <textarea class="contact-item-detail" name="detail" id="detail" cols="30" rows="10" placeholder="お問い合わせの内容をご記載ください">
                {{ old('detail',$contact['detail'] ?? null) }}
            </textarea>
        </div>
        <p class="form-error">
            @error('detail')
                {{ $message }}
            @enderror
        </p>
        <button class="button contact-button" type="submit">
            確認画面
        </button>
    </form>
</div>
@endsection
