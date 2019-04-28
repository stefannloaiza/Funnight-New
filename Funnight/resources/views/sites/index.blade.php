@extends('layouts.app') 
@section('content')
<div class="container" style=" width: 50%;">
    <div class="row justify-content-center">
        <div class="col-md-12" style=" padding: 0; ">
            @if($inactivity == true)
            <div class="alert alert-warning">
                <h3>Advertencia</h3>
                <hr>
                <b>
                    Estimado usuario te recomendamos no estar inactivo mas de 6 dias
                    o su cuenta se inactivara y debera comunicarse con support@funnight.com
                </b>
            </div>
            @endif
    @include('includes.message') @foreach ($images as $image)
    @include('includes.image',['image'=>$image]) @endforeach

            <!-- PAGINACION -->
            <div class="clearfix"></div>
            {{ $images->links() }}
        </div>
    </div>
</div>
@endsection