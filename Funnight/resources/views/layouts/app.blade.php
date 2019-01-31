<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FUNNIGHT</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{--
    <link href="{{ asset('css/preview.css') }}" rel="stylesheet"> --}} {{--
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css"
    />
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

    <!-- Styles -->
    <style>
        html,
        body {
            background-image: url("../img/fondo2.jpg");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: 100%;
            font-weight: 100;
            /* height: 100vh; */
            margin: 0;
        }

        .titles {
            color: white;
        }

        .form-check {
            padding: 0;
        }

        input[type="checkbox"] {
            margin: 4px -15px 0 0;
        }

        .form-check-label {
            margin-left: 15px;
        }

        .card {
            /* width: 80%; */
            border: 0;
        }

        .row {
            /* background-color: white; */
            border-radius: 5px;
        }

        .searchdata {
            background-color: white;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color: black; border-radius: 0px; ">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    
                    <img src="img/logov2.png" class="img-rounded" id="logo" alt="" style="float: left; width: 15%; height: 100%;">
                </a> --}} {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> --}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto" style="width: 50%;">
                        <img src="{{ asset('img/logov2.png')}}" class="img-rounded" id="logo" alt="" style="float: left; width: 15%; height: 100%;">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" style="float: right;">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                        @else {{--
                        <div class="container-avatar" style="align-center">
                            <img src="img/logov2.png" class="avatar" id="logo" alt="" />
                        </div> --}}

                        <li class="nav-item">
                            <a href="{{route('home')}}" class="nav-link">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link">Parceros</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('user.gustosview')}}" class="nav-link">Establecimiento</a>
                        </li>

                        {{--
                        <li class="nav-item">
                            <a href="{{route('sites.show')}}" class="nav-link">Establecimiento</a>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{route('likes')}}" class="nav-link">Favoritas</a>
                        </li>

                        @if( Auth::user()->hasRole('site') )
                        <li class="nav-item">
                            <a href="{{route('image.create')}}" class="nav-link">Publicacion</a>
                        </li>
                        @endif
                        <li>

                        </li>
                        <li>
    @include('includes.avatar')
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                {{ ucwords( Auth::user()->name ) }} {{--<span class="caret"></span>--}}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile',['id' => Auth::user()->id])}}">
                                                Mi perfil            
                                    </a>
                                <a class="dropdown-item" href="{{route('config')}}">
                                                     Configuración             
                                    </a> @if( Auth::user()->hasRole('admin') )
                                <a class="dropdown-item" href="{{route('administrar')}}">
                                            Reportes             
                                        </a> @endif
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
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