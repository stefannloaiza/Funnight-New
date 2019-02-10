@extends('layout') 
@section('content')
<h1 class="page-header">Publicaciones con mayor cantidad de likes Excel</h1>

<p>
    <a href="{{ route('topusersexcel.excel') }}" class="btn btn-sm btn-primary">
            Descargar productos en Excel
        </a>
</p>
@endsection