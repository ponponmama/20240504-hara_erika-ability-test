@extends('layouts/app_contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<h1 class="confirm-logo">Confirm</h1>
<form class="confirm-form" action="{{ route('contacts.submit') }}" method="post">
    @csrf
    <div class="confirm-table">
        <table class="confirm-table-inner">
            <tr class="confirm-table-row">
                <th class="confirm-table-header">お名前</th>
                <td class="confirm-table-text">
                    <span>
                        {{ $contact['first_name']}}&nbsp;{{ $contact['last_name']}}
                    </span>
                    <input type="hidden" name="first_name" value="{{ $contact['first_name']}}" class="input-hidden" />
                    <input type="hidden" name="last_name" value="{{ $contact['last_name']}}" class="input-hidden" >
                </td>
            </tr>
            <tr class="confirm-table-row">
                <th class="confirm-table-header">性別</th>
                <td class="confirm-table-text">
                    <input type="hidden" name="gender" value="{{ $contact['gender']}}" class="input-hidden" />
                    @if ($contact['gender'] == '1')
                    男性
                    @elseif ($contact['gender'] == '2')
                    女性
                    @elseif ($contact['gender'] == '3')
                    その他
                    @endif
                </td>
            </tr>
            <tr class="confirm-table-row">
                <th class="confirm-table-header">メールアドレス</th>
                <td class="confirm-table-text">
                    <span>{{ $contact['email']}}</span>
                    <input type="hidden" name="email" value="{{ $contact['email']}}" class="input-hidden" />
                </td>
            </tr>
            <tr class="confirm-table-row">
                <th class="confirm-table-header">電話番号</th>
                <td class="confirm-table-text">
                    <span>{{ $contact['tell1'] }}{{ $contact['tell2'] }}{{ $contact['tell3'] }}</span>
                    <input type="hidden" name="tell" value="{{ $contact['tell1']}}{{ $contact['tell2'] }}{{ $contact['tell3'] }}" class="input-hidden" />
                </td>
            </tr>
            <tr class="confirm-table-row">
                <th class="confirm-table-header">住所</th>
                <td class="confirm-table-text">
                    <span>{{ $contact['address']}}</span>
                    <input type="hidden" name="address" value="{{ $contact['address']}}" class="input-hidden" />
                </td>
            </tr>
            <tr class="confirm-table-row">
                <th class="confirm-table-header">建物名</th>
                <td class="confirm-table-text">
                    <span>{{ $contact['building'] }}</span>
                    <input type="hidden" name="building" value="{{ $contact['building'] }}" class="input-hidden" />
                </td>
            </tr>
            <tr class="confirm-table-row">
                <th class="confirm-table-header">
                    お問い合わせの種類
                </th>
                <td class="confirm-table-text">
                    @foreach($categories as $category)
                    @if ($contact['category_id'] == $category->id){{ $category->content }}
                    <input type="hidden" name="selected_category_id" value="{{ $category->id }}" class="input-hidden" />
                    @endif
                    @endforeach
                </td>
            </tr>
            <tr class="confirm-table-row-detail">
                <th class="confirm-table-header">お問い合わせ内容</th>
                <td class="confirm-table-text">
                    <span>{{ $contact['detail'] }}</span>
                    <input type="hidden" name="detail" value="{{ $contact['detail'] }}" class="input-detail-hidden">
                </td>
            </tr>
        </table>
    </div>
    <div class="form-button">
        <button type="submit" class="form-button-submit" name="submit_action" value="submit">
            送信
        </button>
        <button type="submit" class="form-button-edit" name="submit_action" value="edit">
            修正
        </button>
    </div>
</form>
@endsection
