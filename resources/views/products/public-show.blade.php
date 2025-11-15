@extends('layouts.public')

@section('title', $product->name)

@section('content')
<div class="bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-white">Inicio</a> / 
            <a href="{{ route('products.public.index') }}" class="hover:text-white">Productos</a> / 
            <span class="text-white">{{ $product->name }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <div class="bg-gray-800 rounded-lg p-8 flex items-center justify-center">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="max-h-96 object-contain">
                @else
                    <span class="text-9xl">&#128230;</span>
                @endif
            </div>

            <div>
                <span class="text-sm text-blue-400 font-semibold uppercase">{{ $product->category->name ?? 'Sin categoría' }}</span>
                <h1 class="text-4xl font-bold text-white mt-2 mb-4">{{ $product->name }}</h1>
                
                <div class="flex items-baseline gap-4 mb-6">
                    <span class="text-5xl font-bold text-blue-400">${{ number_format($product->price, 2) }}</span>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-semibold text-white mb-3">Descripción</h3>
                    <p class="text-gray-300 leading-relaxed">{{ $product->description ?? 'Sin descripción disponible' }}</p>
                </div>

                <div class="flex items-center gap-4 mb-6">
                    <div class="bg-gray-800 px-6 py-3 rounded-lg">
                        <span class="text-gray-400">Stock disponible:</span>
                        <span class="text-white font-bold ml-2">{{ $product->stock }} unidades</span>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-lg transition transform hover:scale-105">
                        Agregar al Carrito
                    </button>
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-4 rounded-lg transition">
                        Favorito
                    </button>
                </div>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
            <div class="border-t border-gray-800 pt-12">
                <h2 class="text-3xl font-bold text-white mb-8">Productos Relacionados</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                            <div class="h-48 bg-gray-700 flex items-center justify-center">
                                @if($related->image)
                                    <img src="{{ $related->image }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-6xl">&#128230;</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-white mb-2">{{ $related->name }}</h3>
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-bold text-blue-400">${{ number_format($related->price, 2) }}</span>
                                    <a href="{{ route('products.public.show', $related->id) }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                        Ver
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection