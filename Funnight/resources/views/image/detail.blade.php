@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
    @include('includes.message')

            <div class="card pub_image pub_image_detail">
                <div class="card-header">

                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
                    </div>
                    @endif

                    <div class="data-user">
                        <a href="{{ route('profile',['id'=>$image->user->id]) }}">
                                    {{ ucwords($image->user->name.' '.$image->user->surname)  }}
                                        <span class="nickname">
                                            {{ $image->user->nick }}
                                        </span>
                                    </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="image-container" style="max-height: none;">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}" />
                        
                    </div>


                    <div class="description">
                        <span class="nickname">{{$image->user->nick}}</span>
                        <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                        <br><br>
                        <p>{{ ucfirst($image->description) }}</p>
                    </div>

                    <div class="likes">

                        <!-- comprobar si el usuario le dio like a la iamgen-->
                        <?php $user_like = false; ?> @foreach ($image->likes as $like) @if($like->user->id == Auth::user()->id)
                        <?php $user_like = true; ?> @endif @endforeach @if($user_like)
                        <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike" /> @else
                        <img src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like" /> @endif

                        <span class="number_likes">{{count($image->likes)}}</span>
                    </div>

                    @if(Auth::user() && Auth::user()->id == $image->user->id)
                    <div class="actions">
                        <a href="{{route('image.edit', ['id'=>$image->id])}}" class="btn btn-sm btn-primary">Actualizar</a>                        {{-- <a href="" class="btn btn-sm btn-danger">Borrar</a> --}}

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
                            Eliminar
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿Estas seguro?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        Si eliminas esta imagen nunca podras recuperarla, ¿estas seguro de querer borrarla?
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-succes" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('image.delete',['id'=>$image->id])}}" class="btn btn-danger">Borrar definitivamente</a>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    @endif


                    <div class="clearfix"></div>
                    <div class="comments">

                        <h2>Comentarios ({{count($image->comments)}})</h2>
                        <hr>
                        <form method="POST" action="{{route('comment.save')}}">
                            @csrf
                            
                            <input type="hidden" name="image_id" value="{{$image->id}}" />
                            <p>
                                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : ''}}" name="content"></textarea>                                @if($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                               <strong>{{ $errors->first('content') }}</strong>
                               </span> @endif
                            </p>
                            <button type="submit" class="btn btn-success">
                                   Enviar
                           </button>
                        </form>



                        <hr> @foreach ($image->comments as $comment )
                        <div class="comment">

                            {{-- @if($image->image_path <> null && $image->image_path <> "")
                            <img src="{{ route('user.avatar',['filename'=>$image->image_path]) }}"/> 
                            @else
                            <img src="{{ asset('img/profile1.jpg') }}" class="avatar center" /> 
                            @endif --}}
                            <span class="nickname">{{$comment->user->nick}}</span>
                            <span class="nickname date"> {{' | '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                            <br>
                            <p>{{ $comment->content }}</p>

                            @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id== Auth::user()->id))
                            <form action="{{url('comment')}}/{{'update'}}/{{$comment->id}}" method="GET">
                                <a href="{{ route('comment.delete',['id'=>$comment->id]) }}" class="btn btn-sm btn-danger">            
                                    Eliminar
                                </a> {{--
                                <form action="{{route('actualizarcomentario')}}" method="GET"> --}}
                                    <button class="btn btn-sm btn btn-warning">
                                                Actualizar
                                            </button>
                                </form>




                                @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection