@extends('layout') 
@section('content')
<h1 class="page-header">Reporte TOP establecimientos</h1>

<p>
    <a href="{{ route('topestablecimientoexcel.excel') }}" class="btn btn-sm btn-primary">
            Descargar TOP establecimientos en Excel
        </a>
</p>
@endsection