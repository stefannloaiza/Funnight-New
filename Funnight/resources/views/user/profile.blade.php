@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="profile-user">

                @if($user->image)
                <div class="container-avatar">
                    <img src="{{ route('user.avatar',['filename'=>$user->image]) }}" class="avatar" />
                </div>

                @endif

                <div class="user-info">
                    <h1>{{'@'.$user->nick}}</h1>
                    <h2>{{$user->name.' '.$user->surname}}</h2>
                    <p>{{'Se unio: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                </div>

                {{-- Calificacion por estrellas 1--}}

                <div class="user-info ratings">
                    <input id="input-1" name="input-1" class="rating rating-loading btn-stars" data-id="{{ $user->id }}" data-min="0" data-max="5"
                        data-step="1" value="{{ round($user->userAverageRating)   }}" data-size="xs" style="height: 40px;">
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <hr>
            </div>
            <div>


                <title>Descripcion Perfil</title>

                <h1>Mis Gustos! FunNight</h1>

                <table class="table">
                    <tr>

                        <th>Pais </th>
                        <th>Tipo de Musica</th>
                        <th>Tipo de Comida</th>
                        <th>Tipo de Ambiente</th>
                        <th>Tipo de Establecimiento</th>

                    </tr>



                    <tr>



                        <td>{{$paises->nombre}}</td>
                        <td>{{$ambientes->nombre}}</td>
                        <td>{{$musica->nombre}}</td>
                        <td>{{$comidas->nombre}}</td>
                        <td>{{$tipoEstablecimiento->nombre}}</td>






                    </tr>

                </table>
            </div>

            <div class="clearfix">
            </div>

            @foreach ($user->images as $image)
    @include('includes.image',['image'=>$image]) @endforeach
        </div>
    </div>

    <script type="text/javascript">
        $("#input-id").rating();
    </script>
</div>
@endsection