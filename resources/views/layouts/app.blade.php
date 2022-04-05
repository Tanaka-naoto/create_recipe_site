<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forum.css') }}" rel="stylesheet">



    @yield('css')

    {{-- @stack('css') --}}

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="{{ url('/mycart') }}">
                                        カートを見る
                                    </a>
                                </div>
                            </li>
                            <a href="{{ url('/mycart') }}" >
                                <img src="{{ asset('image/cart.svg') }}" class="cart" >
                            </a>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="">
        {{-- @if (Auth::check() && Auth::user()->hasVerifiedEmail()) --}}
            @yield('content')
        </main>

            <footer class="footer_design">

                @guest
                    <p class="nav-item" style="display:inline;">
                        <a class="nav-link" href="{{ route('login') }}" style="color:#fefefe; display:inline;">{{ __('ログイン') }}</a>

                    @if (Route::has('register'))

                            <a class="nav-link" href="{{ route('register') }}" style="color:#fefefe; display:inline;">{{ __('会員登録') }}</a>
                    </p>
                    @endif

                @endguest
                <br>
                <div style="margin-top:24px;">
                なんでも売ります<br>
                <p style="font-size:2.4em">Larashop</p><br>
                </div>

                <p style="font-size:0.7em;">@copyright @mukae9</p>

            </footer>
        {{-- @else --}}
        {{-- @yield('content') --}}

        {{-- @endif --}}

    </div>
</body>
</html>
