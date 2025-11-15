@extends('layouts.public')

@section('title', 'Productos')

@section('content')
<div class="bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-4">Todos los Productos</h1>
            <p class="text-gray-400">Explora nuestro catálogo completo</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-gray-800 rounded-lg p-6 sticky top-20">
                    <h3 class="text-xl font-bold text-white mb-4">Filtros</h3>
                    
                    <form method="GET" action="{{ route('products.public.index') }}">
                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Buscar</label>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Nombre del producto..." 
                                class="w-full bg-gray-700 text-gray-100 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Categoría</label>
                            <select name="category" class="w-full bg-gray-700 text-gray-100 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Todas las categorías</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Precio</label>
                            <div class="flex gap-2">
                                <input 
                                    type="number" 
                                    name="min_price" 
                                    value="{{ request('min_price') }}"
                                    placeholder="Mín" 
                                    class="w-1/2 bg-gray-700 text-gray-100 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                <input 
                                    type="number" 
                                    name="max_price" 
                                    value="{{ request('max_price') }}"
                                    placeholder="Máx" 
                                    class="w-1/2 bg-gray-700 text-gray-100 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                            Aplicar Filtros
                        </button>
                        <a href="{{ route('products.public.index') }}" class="block w-full text-center bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 rounded-lg transition mt-2">
                            Limpiar
                        </a>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-3">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                                <div class="h-48 bg-gray-700 flex items-center justify-center">
                                    @if($product->image)
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-6xl">&#128230;</span>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <span class="text-xs text-blue-400 font-semibold uppercase">{{ $product->category->name ?? 'Sin categoría' }}</span>
                                    <h3 class="text-lg font-semibold text-white mt-2 mb-2">{{ $product->name }}</h3>
                                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-2xl font-bold text-blue-400">${{ number_format($product->price, 2) }}</span>
                                        <a href="{{ route('products.public.show', $product->id) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                                            Ver más
                                        </a>
                                    </div>
                                    <div class="mt-3 text-sm text-gray-400">
                                        Stock: <span class="font-semibold">{{ $product->stock }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-xl text-gray-400 mb-4">No se encontraron productos</p>
                        <a href="{{ route('products.public.index') }}" class="text-blue-400 hover:text-blue-300">Ver todos los productos</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection