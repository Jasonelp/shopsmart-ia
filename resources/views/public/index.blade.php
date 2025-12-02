@extends('layouts.app-simple')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900 py-10">

    <div class="max-w-7xl mx-auto px-6 text-white">

        <!-- Título -->
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-extrabold text-green-400 drop-shadow-lg">
                Catálogo de Productos
            </h1>
            <p class="text-gray-400 mt-2">Explora artículos con asistencia IA inteligente</p>
        </div>

        <!-- CONTENEDOR DEL GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($products as $product)
                <!-- CARD NEON -->
                <div class="group bg-gray-800/40 border border-white/10 rounded-2xl p-5 
                            backdrop-blur-xl shadow-xl transition-all 
                            hover:shadow-[0_0_25px_rgba(0,255,170,0.4)]
                            hover:border-green-500/40 hover:-translate-y-1 cursor-pointer">

                    <!-- Imagen -->
                    <a href="{{ route('products.public.show', $product->id) }}">
                        <div class="w-full h-48 bg-gray-900 rounded-xl overflow-hidden flex items-center justify-center mb-4 shadow-inner">
                            <img src="{{ $product->image_url }}"
                                 class="max-h-48 object-contain transition group-hover:scale-105 
                                        drop-shadow-[0_0_10px_rgba(0,255,170,0.25)]" 
                                 alt="{{ $product->name }}">
                        </div>
                    </a>

                    <!-- Nombre -->
                    <h2 class="text-xl font-bold mb-2 group-hover:text-green-400 transition">
                        {{ $product->name }}
                    </h2>

                    <!-- Descripción corta -->
                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                        {{ $product->description ?? 'Sin descripción' }}
                    </p>

                    <!-- Info -->
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-green-400 font-bold text-lg">
                            S/. {{ number_format($product->price, 2) }}
                        </span>

                        <span class="@if($product->stock > 10) text-green-300 
                                     @elseif($product->stock > 0) text-yellow-300 
                                     @else text-red-400 @endif text-sm">
                            Stock: {{ $product->stock }}
                        </span>
                    </div>

                    <!-- Botón IA -->
                    <button onclick="toggleAssistant()"
                        class="w-full bg-gradient-to-r from-green-600 to-teal-700
                               hover:from-green-500 hover:to-teal-600
                               text-white py-2 rounded-xl font-semibold
                               shadow-[0_0_15px_rgba(0,255,170,0.5)]
                               transition-all active:scale-95">
                        💬 Preguntar a la IA
                    </button>
                </div>

            @empty
                <p class="text-center text-gray-400 col-span-3">No hay productos disponibles.</p>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="mt-10">
            {{ $products->links('pagination::tailwind') }}
        </div>

    </div>
</div>
@endsection
