@extends('layout') 
@section('content')
<h1 class="page-header">Listado de los establecimientos mejor calificados</h1>
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Descripción</th>

        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>

        </tr>
        @endforeach
    </tbody>
</table>
<hr>
<p>
    <a href="{{ route('products.excel') }}" class="btn btn-sm btn-primary">
            Descargar productos en Excel
        </a>
</p>
@endsection