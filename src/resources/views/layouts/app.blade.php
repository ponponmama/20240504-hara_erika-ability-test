<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/ress.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body class="app-body">
    <header class="header-section">
        <h1 class="header-logo">
            FashionablyLate
        </h1>
        @yield('heading__link')
    </header>
    <main class="main-section">
        @yield('content')
    </main>
</body>

</html>
