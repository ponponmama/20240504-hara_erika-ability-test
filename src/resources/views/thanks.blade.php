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
        <a href="{{ $url }}" class="link thanks__link">HOME</a>
    </div>
</div>
@endsection
