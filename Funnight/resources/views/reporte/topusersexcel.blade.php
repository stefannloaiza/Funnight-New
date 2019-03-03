@extends('layout') 
@section('content')


<!-- Styles -->
<style>
    html,
    body {
        background-image: url("{{ asset('img/fondo2.jpg') }}");
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: 100%;
        font-weight: 100;
        /* height: 100vh; */
        margin: 0;
    }

    .titles {
        color: white;
    }

    .form-check {
        padding: 0;
    }

    input[type="checkbox"] {
        margin: 4px -15px 0 0;
    }

    .form-check-label {
        margin-left: 15px;
    }

    .card {
        /* width: 80%; */
        border: 0;

        margin-bottom: 25px;
        color: aquamarine;
        background-color: rgba(11, 11, 11, .9);
        /* border-bottom: 1px solid rgba(0,0,0,.125);     */
        border-radius: 7px;
    }

    .row {
        /* background-color: white; */
        border-radius: 5px;
    }

    .center {
        margin: auto;
        width: 50%;
        padding: 10px;
        color: aquamarine;
    }
</style>
<div class="center">
    <h1 class="page-header">Publicaciones con mayor cantidad de likes Excel</h1>
</div>

<div class="center">
    <p>
        <a href="{{ route('topusersexcel.excel') }}" class="btn btn-sm btn-primary">
            Descargar productos en Excel
        </a>
    </p>
</div>
@endsection