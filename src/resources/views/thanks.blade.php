@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__back">
        <h1 class="thanks__front">
            お問い合わせありがとうございました
        </h1>
        <h2 class="thanks">
                Thank you
        </h2>
        <div class="thanks__button">
            <a href="{{ $url }}" class="thanks__button-submit">HOME</a>
        </div>
    </div>
</div>
@endsection
