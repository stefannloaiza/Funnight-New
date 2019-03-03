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
                    <h1>{{ ucfirst($user->nick) }}</h1>
                    <h2>{{ ucwords($user->name.' '.$user->surname) }}</h2>
                    <p>{{'Se unio: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>

                    @if( $user->hasRole('site') ) @if (isset($followSite))
                    <button name="followSite" id="{{ $user->id }}" type="button" class="btn btn-primary btn-block followSite" hidden="hidden">
                                Seguir
                            </button>
                    <button name="unfollowSite" id="{{ $user->id }}" type="button" class="btn btn-success btn-block unfollowSite">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Seguido
                            </button> @else
                    <button name="followSite" id="{{ $user->id }}" type="button" class="btn btn-primary btn-block followSite">
                                Seguir
                            </button>
                    <button name="unfollowSite" id="{{ $user->id }}" type="button" class="btn btn-success btn-block unfollowSite" hidden="hidden">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Seguido
                            </button> @endif @endif @if( $user->hasRole('user') && $user->id != Auth::user()->id
                    ) @if (isset($friend))
                    <button name="unFollowFriend" id="{{ $user->id }}" type="button" class="btn btn-success btn-block unFollowFriend">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Amigo seguido
                            </button>
                    <button name="followFriend" id="{{ $user->id }}" type="button" class="btn btn-primary btn-block followFriend" hidden="hidden">
                                Amigo
                            </button> @else
                    <button name="followFriend" id="{{ $user->id }}" type="button" class="btn btn-primary btn-block followFriend">
                                Amigo
                            </button>
                    <button name="unFollowFriend" id="{{ $user->id }}" type="button" class="btn btn-success btn-block unFollowFriend" hidden="hidden">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Amigo seguido
                            </button> @endif @endif
                </div>

                {{-- Calificacion por estrellas 1--}}

                <div class="user-info ratings">
                    @if( $user->hasRole('site') )
                    <input id="input-1" name="input-1" class="rating rating-loading btn-stars" data-id="{{ $user->id }}" data-min="0" data-max="5"
                        data-step="1" value="{{ round($user->userAverageRating)   }}" data-size="xs" style="height: 40px;">
                    <div class="clearfix"></div>
                    <br> @endif @if( $user->hasRole('user') )
                    <a href="{{ route('user.friendList',['id'=>$user->id]) }}">
                        <button name="unFollowFriend" id="{{ $user->id }}" type="button" class="btn btn-warning btn-block">
                            <span class="glyphicon glyphicon-list" aria-hidden="true"></span> Lista de amigos
                        </button>
                    </a> @endif
                </div>

                <div class="user-info">
                </div>
            </div>
            <br>

            <div class="table-responsive">
                <h2>Mis Gustos!</h2>
                <hr>
                <table class="table table-striped">
                    <tr>
                        <th class="text-center">Pais</th>
                        <th class="text-center">Tipo de Ambiente</th>
                        <th class="text-center">Tipo de Musica</th>
                        <th class="text-center">Tipo de Comida</th>
                        <th class="text-center">Tipo de Establecimiento</th>
                        @if ($user->hasRole('site'))
                        <th class="text-center">Precio de Establecimiento</th>
                        @endif
                    </tr>
                    <tr class="text-center">
                        <td>{{ $paises->nombre }}</td>
                        <td>{{ $ambientes->nombre }}</td>
                        <td>{{ $musica->nombre }}</td>
                        <td>{{ $comidas->nombre }}</td>
                        <td>{{ $tipoEstablecimiento->nombre }}</td>
                        @if ($user->hasRole('site'))
                        <td>{{ $precio->valor}}</td>
                        @endif
                    </tr>
                </table>
                <hr>
            </div>

            @if ($user->hasRole('user')) {{--
            <h2>Actividad</h2>
            <hr>
            <div class="row text-center">
                <div class="col-md-4">
                    <button type="button" class="btn btn-info btn-lg btn-block">Establecimientos seguidos</button>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary btn-lg btn-block">Est. seguidos por mis amigos</button>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary btn-lg btn-block">Est. con mis gustos</button>
                </div>
            </div>

            <br> --}}

            <div class="images_profile">
                <h2>Establecimientos Seguidos</h2>
                <hr> @foreach ($follows as $follow)
                <div class="profile-user">
                    <div class="container-avatar">
                        @if ($follow->image
                        <> null && $follow->image
                            <> "")
                                <img src="{{ route('user.avatar',['filename' => $follow->image]) }}" class="avatar" /> @else
                                <img src="{{ asset('img/profile1.jpg') }}" class="avatar center" /> @endif
                    </div>

                    <div class="user-info">
                        <h2>{{ $follow->nick }}</h2>
                        <h3>{{ $follow->name.''.$follow->surname }}</h3>
                        <p>{{ 'Se unio: '.\FormatTime::LongTimeFilter($follow->created_at) }}</p>
                        <a href="{{ route('profile',['id'=>$follow->id]) }}" class="btn btn-info">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Perfil
                            </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                @endforeach
            </div>

            <br>

            <div class="images_profile">
                <h2>Est. seguidos por mis amigos</h2>
                <hr> @foreach ($friendsSites as $friendSite)
                <div class="profile-user">
                    <div class="container-avatar">
                        @if($friendSite->image
                        <> null && $friendSite->image
                            <> "")
                                <img src="{{ route('user.avatar',['filename'=>$friendSite->image]) }}" class="avatar" />                                @else
                                <img src="{{ asset('img/profile1.jpg') }}" class="avatar center" /> @endif
                    </div>

                    <div class="user-info">
                        <h2>{{ $friendSite->nick }}</h2>
                        <h3>{{ $friendSite->name.''.$friendSite->surname }}</h3>
                        <p>{{ 'Se unio: '.\FormatTime::LongTimeFilter($friendSite->created_at) }}</p>
                        <a href="{{ route('profile',['id'=>$friendSite->id]) }}" class="btn btn-info">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Perfil
                            </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                @endforeach
            </div>

            <br>

            <div class="images_profile">
                <h2>Est. con mis gustos</h2>
                <hr> @foreach ($sitesFollowPleasure as $sitesFollow)
                <div class="profile-user">
                    <div class="container-avatar">
                        @if($sitesFollow->image
                        <> null && $sitesFollow->image
                            <> "")
                                <img src="{{ route('user.avatar',['filename'=>$sitesFollow->image]) }}" class="avatar" />                                @else
                                <img src="{{ asset('img/profile1.jpg') }}" class="avatar center" /> @endif
                    </div>

                    <div class="user-info">
                        <h2>{{ $sitesFollow->nick }}</h2>
                        <h3>{{ $sitesFollow->name.''.$sitesFollow->surname }}</h3>
                        <p>{{'Se unio: '.\FormatTime::LongTimeFilter($sitesFollow->created_at)}}</p>
                        <a href="{{ route('profile',['id'=>$sitesFollow->id]) }}" class="btn btn-info">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Perfil
                            </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                @endforeach
            </div>

            @endif

            <br> {{-- inicio publicaciones comentadas--}} @if ($user->hasRole('user'))
            <div class="images_profile">
                <h2>Publicaciones comentadas</h2>
                <hr> {{-- @if ($user->images != null && $user->images != "") --}} @foreach ($pubs as $pub)
    @include('includes.image',['image'=>$pub])
                @endforeach {{-- @else
                <small>Este usuario no tiene publicaciones.</small> @endif --}}
            </div>
            @endif {{-- fin publicaciones comentadas --}}
            <div class="clearfix"></div>

            <br> @if ($user->hasRole('site'))
            <div class="images_profile">
                <h2>Publicaciones</h2>
                <hr> @if ($user->images != null && $user->images != "") @foreach ($user->images as $image)
    @include('includes.image',['image'=>$image])
                @endforeach @else
                <small>Este usuario no tiene publicaciones.</small> @endif
            </div>
            @endif {{-- Fin de las publicaciones --}}
            <br>
        </div>
    </div>

    <script type="text/javascript">
        $("#input-id").rating();
    </script>
</div>
@endsection