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

    <!-- 追加  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
