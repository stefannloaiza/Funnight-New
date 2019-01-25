<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FUNNIGHT</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html,
        body {
            background-image: url("img/fondo2.jpg");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: 100%;
            background-color: #fff;
            color: white;
            font-weight: 100;
            /* height: 100vh; */
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 30px;
        }

        .content {
            text-align: center;
            margin: 15%;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: white;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links>a:hover {
            color: #23C8F9;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        #logo {
            width: 5%;
            margin: 1%;
        }

        .lead {}
    </style>
</head>

<body>
    <div class="position-ref">
        <div class="logo">
            <img src="img/logov2.png" class="img-rounded" id="logo" alt="">
        </div>
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">{{ __('welcome.home') }}</a> @else
            <a href="{{ route('login') }}">{{ __('welcome.login') }}</a>
            <a href="{{ route('register') }}">{{ __('welcome.register') }}</a> @endauth
        </div>
        @endif

        <div class="content">
            <div class="title">
                <p>
                    <b>
                        Fun Night
                    </b>
                </p>
            </div>
            <br>
            <p class="lead">
                Fun Night te ayuda a encontrar tu sitio nocturno favorito, registrate como usuario para encuentres tu sitio ideal o resgistra
                tu establecimiento nocturno, haz parte de esta comunidad y comienza a crecer tu negocio.
            </p>
            <br>
            <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Registrate</a>
        </div>
    </div>
</body>

</html>