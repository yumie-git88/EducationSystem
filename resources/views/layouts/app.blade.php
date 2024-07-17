<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <header>
        <nav class="nav">
            <ul class="menu">
                <li><a href="#jyugyou">授業管理</a></li>
                <li><a href="#news">お知らせ管理</a></li>
                <li><a href="#banner">バナー管理</a></li>
                <li><a href="{{ route('curriculum_list') }}" class="button">一覧に戻る</a></li>
                <li><a href="{{ route('home') }}" class="button">ログアウト</a></li>
            </ul>
        </nav>
    </header>

    <div id="app">
        <!-- Navbar and Main Content -->
    </div>

</body>
</html>