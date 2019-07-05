@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center searchdata">

        <div class="col-md-8">

            <h1>Establecimientos Seguidos</h1>

            <hr> @foreach ($follows as $follow)
                <div class="profile-user">
                    <div class="container-avatar">
                        @if ($follow->image
                        <> null && $follow->image
                            <> "")
                                <img src="{{ route('user.avatar',['filename' => $follow->image]) }}" class="avatar" />
                                @else
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
            <br>
        </div>
    </div>
</div>
@endsection