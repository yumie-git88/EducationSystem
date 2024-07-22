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
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

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
                    <!-- <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.index') }}">{{ __('時間割') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.index') }}">{{ __('授業進捗') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.index') }}">{{ __('プロフィール設定') }}</a>
                        </li>
                    </ul> -->

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
                        
                            <!-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('login.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('login.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li> -->
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
