<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Mobilne Przedszkole</title>
    <meta name="description" content="">
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/app/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/app/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/app/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/app/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/app/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/app/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/app/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/app/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/app/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/app/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/app/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/app/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/app/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('image/app/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#000000">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/application.css')}}">

    <script src="{{asset('js/ckeditor.js')}}"></script>

</head>
<body>

<header class="headerApp">
    <a href="{{route('login')}}" class="headerApp__logoWrapper">
        <img src="{{asset('images/app/logo.svg')}}" alt="Mobilne Przedszkole" class="headerApp__logo">
    </a>

    <ul class="headerApp__links">
        @guest
            @if (Route::has('login'))
                <li>
                    <a class="nav-link" href="{{ route('index.show') }}">{{ __('Strona główna') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <img src="{{asset('images/app/icons/messages.svg')}}" alt="">
                    Wiadomości
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{route('profile.show')}}">
                    <img src="{{asset('images/app/icons/user-config.svg')}}" alt="">
                    {{ __('Profil') }}
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="{{asset('images/app/icons/logout.svg')}}" alt="">
                    Wyloguj
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
            {{--            <li class="nav-item dropdown">--}}
            {{--                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
            {{--                    <img src="{{asset('images/app/login/user.svg')}}" alt=""> {{Auth::user()->first_name}} {{Auth::user()->last_name}}--}}
            {{--                </a>--}}

            {{--                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}

            {{--                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
            {{--                       onclick="event.preventDefault();--}}
            {{--                                                     document.getElementById('logout-form').submit();">--}}
            {{--                        {{ __('Wyloguj') }}--}}
            {{--                    </a>--}}

            {{--                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
            {{--                        @csrf--}}
            {{--                    </form>--}}
            {{--                </div>--}}
            {{--            </li>--}}
        @endguest
    </ul>

</header>
<main class="main">
    @guest
    @else
        @include('navigation.show')
    @endguest

    <div class="content {{\Request::route()->getName() == "login" ? '-login' : ''}}">

        @yield('content')
    </div>

</main>

<footer class="footerApp">
    <div>Icons made by <a href="https://www.freepik.com" target="_blank" title="Freepik">Freepik</a> from <a
            href="https://www.flaticon.com/" target="_blank" title="Flaticon">www.flaticon.com</a></div>
    <div><span class="footerApp__author">Aplikacja stworzona przez: <a href="https://github.com/mkardas98"
                                                                       target="_blank"> Mariusz Kardaś</a></span></div>
</footer>
<div class="load"><div id="preload"></div></div>

<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/chart.min.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}" defer></script>
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
@stack('scripts.body.bottom')
</body>
</html>
