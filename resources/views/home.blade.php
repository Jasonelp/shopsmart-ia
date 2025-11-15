@extends('layouts.public')

@section('title', 'Inicio')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-900 via-gray-900 to-purple-900 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
            Bienvenido a <span class="text-blue-400">ShopSmart IA</span>
        </h1>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            Descubre los mejores productos con la ayuda de inteligencia artificial. 
            Encuentra exactamente lo que buscas de manera rápida y sencilla.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.public.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition transform hover:scale-105">
                Ver Productos
            </a>
            <a href="{{ route('categories.public.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold px-8 py-3 rounded-lg transition transform hover:scale-105">
                Explorar Categorías
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-white mb-8 text-center">Categorías Destacadas</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @forelse($categories as $category)
                <a href="{{ route('categories.public.show', $category->id) }}" 
                   class="bg-gray-700 hover:bg-gray-600 rounded-lg p-6 text-center transition transform hover:scale-105">
                    <div class="text-4xl mb-3">🏷️</div>
                    <h3 class="text-white font-semibold">{{ $category->name }}</h3>
                    <p class="text-gray-400 text-sm mt-1">{{ $category->products_count }} productos</p>
                </a>
            @empty
                <div class="col-span-full text-center text-gray-400 py-8">
                    No hay categorías disponibles
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-16 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-white">Productos Destacados</h2>
            <a href="{{ route('products.public.index') }}" class="text-blue-400 hover:text-blue-300 font-semibold">
                Ver todos →
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($featuredProducts as $product)
                <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                    <div class="h-48 bg-gray-700 flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-6xl">📦</span>
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
            @empty
                <div class="col-span-full text-center text-gray-400 py-12">
                    <p class="text-xl mb-4">No hay productos disponibles</p>
                    <p class="text-sm">Vuelve pronto para ver nuestras ofertas</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-white mb-4">¿Listo para empezar a comprar?</h2>
        <p class="text-xl text-blue-100 mb-8">
            Únete a miles de usuarios que confían en ShopSmart IA para sus compras
        </p>
        @guest
            <a href="{{ route('register') }}" 
               class="bg-white text-blue-600 hover:bg-gray-100 font-bold px-8 py-3 rounded-lg transition transform hover:scale-105 inline-block">
                Crear cuenta gratis
            </a>
        @else
            <a href="{{ route('products.public.index') }}" 
               class="bg-white text-blue-600 hover:bg-gray-100 font-bold px-8 py-3 rounded-lg transition transform hover:scale-105 inline-block">
                Explorar productos
            </a>
        @endguest
    </div>
</section>
@endsection
