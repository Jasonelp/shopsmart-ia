@extends('layouts.app')

@section('content')
<h1>Categorías</h1>
<a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Nueva Categoría</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $cat)
        <tr>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->description }}</td>
            <td>
                <a href="{{ route('categories.edit', $cat->id) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
