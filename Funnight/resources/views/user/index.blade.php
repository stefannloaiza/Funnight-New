@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center searchdata">
        <div class="col-md-8">

            <h1>Parceros</h1>
            <form method="GET" action="{{ route('user.index') }}" id="buscador">
                <div class="row">
                    <div class="form-group col">

                        <input type="text" id="search" class="form-control" />
                    </div>
                    <div class="form-group col btn-search">
                        <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar
                        </button>
                        {{-- <input type="submit" value="Buscar" class="btn btn-success" /> --}}
                    </div>
                </div>
            </form>
            <hr> @foreach ($users as $user)

            <div class="profile-user">
                <div class="container-avatar">
                        @if($user->image <> null && $user->image <> "")
                            <img src="{{ route('user.avatar',['filename'=>$user->image]) }}" class="avatar" />
                        @else
                            <img src="{{ asset('img/profile1.jpg') }}" class="avatar center" />
                        @endif
                    </div>

                <div class="user-info">
                    <h2>{{'@'.$user->nick}}</h2>
                    <h3>{{$user->name.' '.$user->surname}}</h3>
                    <p>{{'Se unio: '.\FormatTime::LongTimeFilter($user->created_at)}}</p>
                    <a href="{{route('profile',['id'=> $user->id])}}" class="btn btn-info">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Perfil
                    </a>
                </div>
                <div class="clearfix"></div>
                <hr>
            </div>

            @endforeach


            <!-- PAGINACION -->
            {{--
            <div class="clearfix"></div>
            {{$users->links()}} --}}
        </div>
    </div>
</div>
@endsection