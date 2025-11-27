@extends('layouts.app-simple')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                            Panel de Administración
                        </h2>
                        <p class="text-gray-600 mt-1">Gestiona tu tienda desde aquí</p>
                    </div>
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        Ver Sitio Público →
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    
                    <a href="{{ route('products.index') }}" 
                       class="block p-6 bg-blue-50 border-2 border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Productos</p>
                                <p class="text-3xl font-bold text-blue-600 mt-2">{{ \App\Models\Product::count() }}</p>
                            </div>
                            <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-blue-700 font-semibold flex items-center">
                            Gestionar Productos
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </p>
                    </a>

                    <a href="{{ route('categories.index') }}" 
                       class="block p-6 bg-green-50 border-2 border-green-200 rounded-lg hover:bg-green-100 hover:border-green-300 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Categorías</p>
                                <p class="text-3xl font-bold text-green-600 mt-2">{{ \App\Models\Category::count() }}</p>
                            </div>
                            <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-green-700 font-semibold flex items-center">
                            Gestionar Categorías
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </p>
                    </a>

                    <a href="{{ route('orders.index') }}" 
                       class="block p-6 bg-purple-50 border-2 border-purple-200 rounded-lg hover:bg-purple-100 hover:border-purple-300 transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Pedidos</p>
                                <p class="text-3xl font-bold text-purple-600 mt-2">{{ \App\Models\Order::count() }}</p>
                            </div>
                            <svg class="w-12 h-12 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="mt-4 text-purple-700 font-semibold flex items-center">
                            Gestionar Pedidos
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </p>
                    </a>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Accesos Rápidos</h3>
                        <div class="space-y-2">
                            <a href="{{ route('products.create') }}" class="block text-blue-600 hover:text-blue-800 font-medium">
                                + Agregar Producto
                            </a>
                            <a href="{{ route('categories.create') }}" class="block text-blue-600 hover:text-blue-800 font-medium">
                                + Agregar Categoría
                            </a>
                            <a href="{{ route('orders.index') }}" class="block text-blue-600 hover:text-blue-800 font-medium">
                                Ver Pedidos Pendientes
                            </a>
                        </div>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Estadísticas</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Productos Activos</span>
                                <span class="font-bold text-gray-900">{{ \App\Models\Product::count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Pedidos del Mes</span>
                                <span class="font-bold text-gray-900">{{ \App\Models\Order::whereMonth('created_at', date('m'))->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Categorías</span>
                                <span class="font-bold text-gray-900">{{ \App\Models\Category::count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:underline font-medium">
                        ← Volver al sitio público
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection