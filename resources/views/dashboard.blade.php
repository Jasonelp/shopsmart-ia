@extends('layouts.app-simple')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Panel de Administración
                </h2>
            </div>
        </div>

        <!-- Cards -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3 class="text-2xl font-bold mb-4">Bienvenido al Dashboard</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <!-- Card Productos -->
                    <a href="{{ route('products.index') }}" class="block p-6 bg-blue-100 rounded-lg hover:bg-blue-200 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Total Productos</p>
                                <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Product::count() }}</p>
                            </div>
                            <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-blue-600 font-semibold">Gestionar Productos →</p>
                    </a>

                    <!-- Card Categorías -->
                    <a href="{{ route('categories.index') }}" class="block p-6 bg-green-100 rounded-lg hover:bg-green-200 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Total Categorías</p>
                                <p class="text-3xl font-bold text-green-600">{{ \App\Models\Category::count() }}</p>
                            </div>
                            <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-green-600 font-semibold">Gestionar Categorías →</p>
                    </a>

                    <!-- Card Pedidos -->
                    <a href="{{ route('orders.index') }}" class="block p-6 bg-purple-100 rounded-lg hover:bg-purple-200 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600">Total Pedidos</p>
                                <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Order::count() }}</p>
                            </div>
                            <svg class="w-12 h-12 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="mt-4 text-purple-600 font-semibold">Gestionar Pedidos →</p>
                    </a>
                </div>

                <div class="mt-8">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:underline">← Volver al sitio público</a>
                </div>

                <div class="mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection