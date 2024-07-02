<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div id="app">
        <nav class="bg-white shadow-sm">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center py-4">
                <div class="flex space-x-4">
                        <a class="text-xl font-semibold text-gray-900 hover:text-gray-700" href="{{ url('/user/top') }}">時間割</a>
                        <a class="text-xl font-semibold text-gray-900 hover:text-gray-700" href="{{ url('/user/top') }}">授業進捗</a>
                        <a class="text-xl font-semibold text-gray-900 hover:text-gray-700" href="{{ url('/user/top') }}">プロフィール設定</a>
                    </div>
                    <div class="block lg:hidden">
                        <button class="text-gray-500 focus:outline-none focus:text-gray-700" onclick="document.getElementById('navbarSupportedContent').classList.toggle('hidden')">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>

                    <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="navbarSupportedContent">
                        <ul class="lg:flex lg:space-x-4">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="text-gray-700 hover:text-gray-900" href="{{ route('user.auth.login') }}">{{ __('ログイン') }}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="text-gray-700 hover:text-gray-900" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toggleButton = document.querySelector('.navbar-toggler');
            var navLinks = document.querySelector('#navbarSupportedContent');

            toggleButton.addEventListener('click', function () {
                navLinks.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>