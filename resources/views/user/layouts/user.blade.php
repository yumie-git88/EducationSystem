<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- 共通レイアウト・共通ヘッダー -->
        <nav class="navbar navbar-expand-md navbar-light bg-warning shadow-sm">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar /時間割/授業進捗/プロフィール設定-->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item m-2">
                            <button type="button" class="btn btn-success" onclick="location.href='{{ route('show.curriculum') }}' ">{{ __('時間割') }}</button>
                        </li>
                        <li class="nav-item m-2">
                            <button type="button" class="btn btn-success" onclick="location.href='{{ route('show.progress') }}' ">{{ __('授業進捗') }}</button>
                        </li>
                        <li class="nav-item m-2">
                            <button type="button" class="btn btn-success" onclick="location.href='{{ route('show.profile') }}' ">{{ __('プロフィール設定') }}</button>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login.index'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login.index') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Route::has('login.logout'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login.logout') }}">{{ __('Logout') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
