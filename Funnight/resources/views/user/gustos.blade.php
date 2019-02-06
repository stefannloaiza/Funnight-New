@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center searchdata">
        <div class="col-md-10">
            <h1>Gustos</h1>
            <hr>
            <form method="GET" action="{{ route('user.gustos') }}" id="buscadorgustos" class="gustosSearch">
                <div class="row">
                    <div class="form-group col">

                        <input type="text" name="search" id="search" class="form-control" />
                    </div>
                    <div class="form-group col btn-search">

                        <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar
                            </button> {{-- <input type="submit" value="buscar" class="btn btn-success"
                        /> --}}
                    </div>
                </div>
                <div class="panel-body">
                    <div>
                        <h2>Puedes buscar de la siguiente forma por tipo:</h2>
                    </div>
                    <table class="table table-striped table-condensed">
                        <tr>
                            <th class="text-center">Ambiente</th>
                            <th class="text-center">Comida</th>
                            <th class="text-center">Establecimiento</th>
                            <th class="text-center">Musica</th>
                            <th class="text-center">Pais</th>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control" name="ambienteUser" id="ambienteUser" style="height: auto;">
                                <option value="">Selecciona el ambiente</option>
                                @foreach ($ambientes as $ambiente)
                                    <option value="{{ $ambiente->id_ambiente }}">{{ $ambiente->nombre }}</option> 
                                @endforeach
                            </select>
                            </td>
                            <td>
                                <select class="form-control" name="comidaSite" id="comidaSite" style="height: auto;">
                                <option value="">Selecciona tu comida</option>
                                @foreach ($comidas as $comida)
                                    <option value="{{ $comida->id_comida }}">{{ $comida->nombre }}</option> 
                                @endforeach
                            </select>
                            </td>
                            <td>
                                <select class="form-control" name="typeSite" id="typeSite" style="height: auto;">
                                <option value="">Selecciona el tipo de establecimiento</option>
                                @foreach ($tipoEstablecimiento as $type)
                                    <option value="{{ $type->id_tipo_establecimiento }}">{{ $type->nombre }}</option> 
                                @endforeach
                            </select>
                            </td>
                            <td>
                                <select class="form-control" name="musicaSite" id="musicaSite" style="height: auto;">
                                <option value="">Selecciona tu musica</option>
                                @foreach ($musica as $music)
                                    <option value="{{ $music->id_musica }}">{{ $music->nombre }}</option> 
                                @endforeach
                            </select>
                            </td>
                            <td>
                                <select class="form-control" name="pais" id="paisUser" style="height: auto;">
                                <option value="">Selecciona el pais</option>
                                @foreach ($paises as $pais)
                                    <option value="{{ $pais->id }}">{{ $pais->nombre }}</option> 
                                @endforeach
                            </select>
                            </td>


                        </tr>
                    </table>
                </div>
            </form>
            <hr>
            <div>
                @foreach ($users as $user)

                <div class="profile-user">
                    <div class="container-avatar">
                        @if($user->image
                        <> null && $user->image
                            <> "")
                                <img src="{{ route('user.avatar',['filename'=>$user->image]) }}" class="avatar" /> @else
                                <img src="{{ asset('img/profile1.jpg') }}" class="avatar center" /> @endif
                    </div>

                    <div class="user-info">
                        <h2>{{$user->nick}}</h2>
                        <h3>{{$user->name.' '.$user->surname}}</h3>
                        <p>{{'Se unio: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                        <a href="{{route('profile',['id'=> $user->id])}}" class="btn btn-info">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Perfil
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                @endforeach
                <br>
            </div>
        </div>
@endsection