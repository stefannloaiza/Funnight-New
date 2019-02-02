<link href="{{ asset('scss/animation.scss') }}" rel="stylesheet">

<div class="titulo_reporte" style="text-align: center;">
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
        <a type="submit" href="{{route('topusers')}}" style="margin: 15px" class="btn btn-primary">Imagenes con mayor cantidad de Likes Pdf</a>


        <a type="submit" href="{{route('topusersexcel')}}" style="margin: 15px" class="btn btn-success">Imagenes con mayor cantidad de Likes Excel</a>
    </div>
    <br/>
    <div>
        <a type="submit" href="{{route('topestablecimiento')}}" style="margin: 15px" class="btn btn-primary">Establecimientos TOP 5 con mayor cantidad de estrellas Pdf</a>

        <a type="submit" href="{{route( 'topestablecimientoexcel')}}" style="margin: 15px" class="btn btn-success">Establecimientos TOP 5 con mayor cantidad de estrellas Excel</a>
    </div>
    <div>
        <a type="submit" href="{{route( 'home')}}" style="margin: 15px" class="btn btn-danger">Volver al Menu Principal</a>
    </div>