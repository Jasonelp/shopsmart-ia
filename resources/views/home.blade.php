@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class="mb-4">Bienvenido a ShopSmart IA</h1>
    <div class="d-flex justify-content-center">
        <a href="{{ route('products.index') }}" class="btn btn-primary mx-2">Productos</a>
        <a href="{{ route('categories.index') }}" class="btn btn-success mx-2">Categorías</a>
    </div>
    <p class="mt-4">Accede a los módulos desde el panel superior si eres Admin.</p>
</div>
@endsection
