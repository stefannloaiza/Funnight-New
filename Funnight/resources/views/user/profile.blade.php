@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center searchdata">
        <div class="col-md-10" style="padding-top: 15px; ">

            <div class="profile-user">
                <div class="container-avatar">
                    @if($user->image
                    <> null && $user->image
                        <> "")
                            <img src="{{ route('user.avatar',['filename'=>$user->image]) }}" class="avatar" /> @else
                            <img src="{{ asset('img/profile1.jpg') }}" class="avatar center" /> @endif
                </div>
                <div class="user-info">
                    <h1>{{$user->nick}}</h1>
                    <h2>{{$user->name.' '.$user->surname}}</h2>
                    <p>{{'Se unio: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>

                    @if( $user->hasRole('site') )
                    <button name="followSite" id="{{ $user->id }}" type="button" class="btn btn-primary btn-block followSite">
                                Seguir
                            </button>
                    <button name="unfollowSite" id="{{ $user->id }}" type="button" class="btn btn-success btn-block unfollowSite" hidden>
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Seguido
                            </button> @endif
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
            @if ($user->hasRole('site'))
            <div class="images_profile">

                <h2>Publicaciones</h2>

                <hr> @if ($user->images != null && $user->images != "") @foreach ($user->images as $image)
    @include('includes.image',['image'=>$image])
                @endforeach @else
                <small>Este usuario no tiene publicaciones.</small> @endif
            </div>
            @endif @if ($user->hasRole('user'))
            <div class="images_profile">
                <h2>Establecimientos Seguidos</h2>
                <hr> @foreach ($follows as $follow)

                <div class="profile-user">
                    <div class="container-avatar">
                        @if($follow->image
                        <> null && $follow->image
                            <> "")
                                <img src="{{ route('user.avatar',['filename'=>$follow->image]) }}" class="avatar" /> @else
                                <img src="{{ asset('img/profile1.jpg') }}" class="avatar center" /> @endif
                    </div>

                    <div class="user-info">
                        <h2>{{$follow->nick}}</h2>
                        <h3>{{$follow->name.' '.$follow->surname}}</h3>
                        <p>{{'Se unio: '.\FormatTime::LongTimeFilter($follow->created_at)}}</p>
                        <a href="{{route('profile',['id'=> $follow->id])}}" class="btn btn-info">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Perfil
                            </a>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                </div>

                @endforeach
            </div>
            @endif
        </div>
    </div>

    <script type="text/javascript">
        $("#input-id").rating();
    </script>
</div>
@endsection