@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center searchdata">
        <div class="col-md-10" style="padding-top: 15px; ">

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

                    @if( $user->hasRole('site') )
                        <button name="" id="" type="button" class="btn btn-success">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Seguir
                        </button> 
                        {{-- <button name="" id="" type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Marcar como favorito
                        </button>  --}}
                    @endif
                </div>

                {{-- Calificacion por estrellas 1--}}

                <div class="user-info ratings">
                    <input id="input-1" name="input-1" class="rating rating-loading btn-stars" data-id="{{ $user->id }}" data-min="0" data-max="5"
                        data-step="1" value="{{ round($user->userAverageRating)   }}" data-size="xs" style="height: 40px;">
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <br>
            <div class="table-responsive">
                <h2>Mis Gustos!</h2>
                <hr>
                <table class="table table-striped ">
                    <tr>
                        <th class="text-center">Pais</th>
                        <th class="text-center">Tipo de Ambiente</th>
                        <th class="text-center">Tipo de Musica</th>
                        <th class="text-center">Tipo de Comida</th>
                        <th class="text-center">Tipo de Establecimiento</th>
                    </tr>
                    <tr class="text-center">
                        <td>{{$paises->nombre}}</td>
                        <td>{{$ambientes->nombre}}</td>
                        <td>{{$musica->nombre}}</td>
                        <td>{{$comidas->nombre}}</td>
                        <td>{{$tipoEstablecimiento->nombre}}</td>
                    </tr>
                </table>
                <hr>
            </div>
            <div class="clearfix"></div>
            <div class="images_profile">
                <h2>Publicaciones</h2>
                <hr> 
                @if ($user->images != null && $user->images != "")
                    @foreach ($user->images as $image)
                        @include('includes.image',['image'=>$image]) 
                    @endforeach
                @else
                    <small>Este usuario no tiene publicaciones.</small>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("#input-id").rating();
    </script>
</div>
@endsection