<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common_contact.css') }}">
    @yield('css')
</head>

<body class="contact-body">
    <header class="header-section">
        <a class="top-logo-link">
            FashionablyLate
        </a>
    </header>
    <main class="main-section">
        @yield('content')
    </main>
</body>

</html>
