@extends('layouts.public')

@section('title', $product->name)

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10 text-white">

    <!-- HEADER DEL PRODUCTO -->
    <div class="flex flex-col md:flex-row gap-10">

        <!-- IMAGEN -->
        <div class="w-full md:w-1/2">
            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/500' }}"
                 class="rounded-xl shadow-xl border border-gray-700">
        </div>

        <!-- INFO PRINCIPAL -->
        <div class="w-full md:w-1/2 space-y-4">
            <h1 class="text-4xl font-extrabold">{{ $product->name }}</h1>

            <p class="text-green-300 text-3xl font-bold">
                S/ {{ number_format($product->price, 2) }}
            </p>

            <p class="text-gray-300">
                Categoría: 
                <span class="text-white font-semibold">{{ $product->category->name }}</span>
            </p>

            <p class="text-gray-400">
                {{ $product->description }}
            </p>

            @if($product->stock > 0)
                <p class="text-green-400 font-semibold">✔ Disponible ({{ $product->stock }} unidades)</p>
            @else
                <p class="text-red-400 font-semibold">✖ Sin stock</p>
            @endif

            <a href="{{ route('add_to_cart', $product->id) }}"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow-lg block text-center mt-4">
               Añadir al carrito
            </a>
        </div>
    </div>

    <!-- BLOQUE DE IA -->
    <div class="mt-12 bg-gray-900/80 backdrop-blur-xl border border-gray-700 p-6 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold mb-4 text-green-300">🤖 Análisis Inteligente del Producto</h2>

        <p class="leading-relaxed text-gray-200 whitespace-pre-line">
            {{ $aiAnalysis }}
        </p>
    </div>

</div>
@endsection
