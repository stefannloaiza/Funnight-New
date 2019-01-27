@extends('layouts.app') 
@section('content')
<div class="container" style=" width: 50%;">
    <div class="row justify-content-center" style=" padding: 0; ">
        <div class="col-md-12">
            @include('includes.message') @foreach ($images as $image)
            @include('includes.image',['image'=>$image]) @endforeach
            <!-- PAGINACION -->
            <div class="clearfix"></div>
            {{-- {{ $images->links() }} --}}
        </div>
    </div>
</div>
@endsection