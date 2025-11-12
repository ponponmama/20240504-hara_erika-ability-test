@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin_modal.css') }}">
@endsection

@section('heading__link')
    <a class="link header-nav-link" href="{{ route('logout') }}">logout</a>
@endsection

@section('content')
    <h2 class="page-logo">
        Admin
    </h2>
    <div class="page-section">
        <form class="page-main-form" action="{{ route('admin.search') }}" method="get">
            @csrf
            @php
            $searchConditions = session('search_conditions');
            @endphp
            <input class="keyword-search" type="text" id="keyword" name="keyword" value="{{ $searchConditions['keyword'] ?? '' }}"
                placeholder="名前やメールアドレスを入力してください" autocomplete="keyword" />
            <div class="arrow-gender-section">
                <select class="gender-select" name="gender-select">
                    <option value="">
                        性別
                    </option>
                    <option value="1" {{ ($searchConditions['gender'] ?? null)==1 ? 'selected' : '' }}>
                        男性
                    </option>
                    <option value="2" {{ ($searchConditions['gender'] ?? null)==2 ? 'selected' : '' }}>
                        女性
                    </option>
                    <option value="3" {{ ($searchConditions['gender'] ?? null)==3 ? 'selected' : '' }}>
                        その他
                    </option>
                </select>
            </div>
            <div class="arrow-enquiry-section">
                <select class="category-select" name="category_id">
                    <option value="" placeholder="お問い合わせの種類">
                        お問い合わせの種類
                    </option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(($searchConditions['category_id'] ?? null)==$category->id)
                        selected @endif>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="arrow-date-section">
                <input class="input__date" id="date" name="date" type="date" value="{{ $searchConditions['date'] ?? '' }}"
                    placeholder="年/月/日" autocomplete="date" />
                <span class="arrow-down"></span>
            </div>
            <div class="button-section">
                <button class="link search__button" type="submit">
                    検索
                </button>
                <a href="{{ route('admin.reset_search') }}" class="link reset__button">
                    リセット
                </a>
            </div>
        </form>
        <div class="middle__admin">
            <div class="link button__export">
                <a href="{{ route('admin.contacts.export_csv') }}" class="contact__export">
                    エクスポート
                </a>
            </div>
            <div class="link pagination">
                {{$contacts->links()}}
            </div>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if(session('redirect_success'))
        <meta http-equiv="refresh" content="3;url={{ route('admin.index') }}">
        @php
        session()->forget('redirect_success');
        @endphp
        @endif
        <div class="listing__hail">
            <table class="contact-table-inner" id="contact__table">
                <tr class="contact-table-row">
                    <th class="contact-table-header">お名前</th>
                    <th class="contact-table-header">性別</th>
                    <th class="contact-table-header">メールアドレス</th>
                    <th class="contact-table-header">お問い合わせの種類</th>
                    <th class="contact-table-header detail-header">お問い合わせの内容</th>
                    <th></th>
                </tr>
                @foreach($contacts as $contact)
                <tr class="contact-row">
                    <td class="contact-cell contact-cell-id">
                        {{ $contact->id }}
                    </td>
                    <td class="contact-cell contact-cell-name">
                        {{ $contact->first_name }} {{ $contact->last_name }}
                    </td>
                    <td class="contact-cell contact-cell-gender">
                        @if ($contact->gender == 1)
                        男性
                        @elseif ($contact->gender == 2)
                        女性
                        @else
                        その他
                        @endif
                    </td>
                    <td class="contact-cell contact-cell-email">
                        {{ $contact->email }}
                    </td>
                    <td class="contact-cell contact-cell-category">
                        {{ $contact->category->content }}
                    </td>
                    <td class="contact-cell detail-cell">
                        <a href="#modal-{{ $contact->id }}" class="link modal_admin" id="modal-link-{{ $contact->id }}">
                            詳細
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    @foreach($contacts as $contact)
    <div class="modal-wrapper" id="modal-{{ $contact->id }}">
        <a href="#!" class="modal-overlay"></a>
        <div class="modal-window">
            <div class="modal-content">
                <table class="modal_table">
                    <tr>
                        <td><strong>お名前:</strong></td>
                        <td>
                            {{ $contact->first_name }} {{ $contact->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                性別:
                            </strong>
                        </td>
                        <td>
                            @if ($contact->gender == 1)
                            男性
                            @elseif ($contact->gender == 2)
                            女性
                            @else
                            その他
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                メールアドレス
                            </strong>
                        </td>
                        <td>
                            {{ $contact->email }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                電話番号
                            </strong>
                        </td>
                        <td>
                            {{ $contact->tell }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                住所
                            </strong>
                        </td>
                        <td>
                            {{ $contact->address }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                建物名:
                            </strong>
                        </td>
                        <td>
                            {{ $contact->building }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                お問い合わせの種類
                            </strong>
                        </td>
                        <td>
                            {{ $contact->category->content }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                お問い合わせの内容
                            </strong>
                        </td>
                        <td>
                            {{ $contact->detail }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal_delete" id="modal-{{ $contact->id }}">
                <form action="{{ route('admin.destroy', ['id' =>$contact->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')" class="delete-btn">削除</button>
                </form>
                <a href="#!" class="modal-close">
                    ×
                </a>
            </div>
        </div>
    </div>
    @endforeach
@endsection
