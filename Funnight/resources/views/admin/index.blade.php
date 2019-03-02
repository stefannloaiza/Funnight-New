@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center searchdata" >
        <div class="col-md-12 text-center">
            <h2>USUARIOS</h2>
            @include('includes.message')
            @include('admin.users')
        </div>
    </div>
</div>
@endsection