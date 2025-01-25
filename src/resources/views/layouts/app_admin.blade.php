<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common_admin.css') }}">
    @yield('css')

</head>

<body class="app-body">
    <header class="header-section">
        <div class="header-utilities">
            <h1 class="header__logo">
                FashionablyLate
            </h1>
            @yield('heading__link')
        </div>
    </header>
    <main class="main-section">
        @yield('content')
    </main>
</body>


</html>
