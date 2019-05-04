@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-8">

            <h1 class="titles">Mis favoritos</h1>
            <hr/> @foreach ($likes as $likeImage )
    @include('includes.image',['image'=>$likeImage]) @endforeach

            <!-- PAGINACION -->
            <div class="clearfix"></div>
            {{-- {{$likes->links()}} --}}
        </div>
    </div>
</div>
@endsection