@extends('layouts.public')

@section('title', $product->name . ' - ShopSmart IA')

@section('content')
<div class="min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-gray-800 rounded-lg shadow-2xl overflow-hidden">
            <div class="md:flex">
                <!-- Imagen del producto -->
                <div class="md:w-1/2 bg-gray-700 flex items-center justify-center p-8">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="max-h-96 object-contain rounded-lg">
                    @else
                        <div class="text-gray-500 text-center">
                            <svg class="h-32 w-32 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-4 text-lg">Sin imagen disponible</p>
                        </div>
                    @endif
                </div>
                
                <!-- Detalles del producto -->
                <div class="md:w-1/2 p-8 text-white">
                    <div class="mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-600 text-white">
                            {{ $product->category->name ?? 'Sin categoría' }}
                        </span>
                    </div>
                    
                    <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>
                    
                    @if($product->description)
                        <p class="text-gray-300 mb-6 text-lg leading-relaxed">{{ $product->description }}</p>
                    @else
                        <p class="text-gray-400 mb-6 italic">Este producto no tiene descripción disponible.</p>
                    @endif
                    
                    <div class="mb-6">
                        <span class="text-5xl font-bold text-blue-400">S/. {{ number_format($product->price, 2) }}</span>
                    </div>
                    
                    <div class="mb-8">
                        @if($product->stock > 0)
                            <p class="text-green-400 font-semibold text-lg flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                En stock ({{ $product->stock }} disponibles)
                            </p>
                        @else
                            <p class="text-red-400 font-semibold text-lg flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                Producto agotado
                            </p>
                        @endif
                    </div>
                    
                    <div class="space-y-4">
                        @if($product->stock > 0)
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg transition duration-200 text-lg">
                                🛒 Añadir al Carrito
                            </button>
                        @else
                            <button disabled class="w-full bg-gray-600 text-gray-400 font-bold py-4 px-6 rounded-lg cursor-not-allowed text-lg">
                                No Disponible
                            </button>
                        @endif
                        
                        <a href="{{ route('products.public.index') }}" class="block w-full text-center bg-gray-700 hover:bg-gray-600 text-white font-semibold py-4 px-6 rounded-lg transition duration-200 text-lg">
                            ← Volver a Productos
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
