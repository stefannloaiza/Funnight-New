<!-- Styles -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{--
<link href="{{ asset('css/preview.css') }}" rel="stylesheet"> --}} {{--
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css"
/>

<!-- Styles -->
<style>
    html,
    body {
        background-image: url("{{ asset('img/fondo2.jpg') }}");
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

        margin-bottom: 25px;
        color: aquamarine;
        background-color: rgba(11, 11, 11, .9);
        /* border-bottom: 1px solid rgba(0,0,0,.125);     */
        border-radius: 7px;
    }

    .row {
        /* background-color: white; */
        border-radius: 5px;
    }

    .center {
        margin: auto;
        width: 50%;
        padding: 10px;
        color: aquamarine;
    }
</style>


<link href="{{ asset('scss/animation.scss') }}" rel="stylesheet">

<div class="titulo_reporte" style="text-align: center; color: purple; ">
    <h1>Bienvenidos a Reportes Funnight ;)</h1>


    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">


    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div>
        <a type="submit" href="{{route('topusers')}}" style="margin: 15px" class="btn btn-primary">Publicaciones con mayor cantidad de Likes Pdf</a>


        <a type="submit" href="{{route('topusersexcel')}}" style="margin: 15px" class="btn btn-success">Publicaciones con mayor cantidad de Likes Excel</a>
    </div>
    <br/>
    <div>
        <a type="submit" href="{{route('topestablecimiento')}}" style="margin: 15px" class="btn btn-primary">Establecimientos TOP 5 con mayor cantidad de estrellas Pdf</a>

        <a type="submit" href="{{route( 'topestablecimientoexcel')}}" style="margin: 15px" class="btn btn-success">Establecimientos TOP 5 con mayor cantidad de estrellas Excel</a>
    </div>
    <div>
        <a type="submit" href="{{route( 'home')}}" style="margin: 15px" class="btn btn-danger">Volver al Menu Principal</a>
    </div>