@extends('layouts.app-simple')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-900 via-teal-800 to-blue-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Panel de Administración</h1>
                <p class="text-gray-300">Bienvenido, {{ Auth::user()->name }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('home') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Ver Tienda
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500/80 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-5 shadow-lg">
                <p class="text-blue-100 text-sm">Total Usuarios</p>
                <p class="text-3xl font-bold text-white">{{ $stats['total_users'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-5 shadow-lg">
                <p class="text-green-100 text-sm">Productos</p>
                <p class="text-3xl font-bold text-white">{{ $stats['total_products'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-5 shadow-lg">
                <p class="text-purple-100 text-sm">Pedidos</p>
                <p class="text-3xl font-bold text-white">{{ $stats['total_orders'] }}</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl p-5 shadow-lg">
                <p class="text-yellow-100 text-sm">Ventas del Mes</p>
                <p class="text-3xl font-bold text-white">S/ {{ number_format($stats['monthly_sales'], 2) }}</p>
            </div>
        </div>

        <!-- Tarjetas de usuarios -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white/10 backdrop-blur rounded-xl p-5 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm">Clientes</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['total_clients'] }}</p>
                    </div>
                    <div class="bg-blue-500/20 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-xl p-5 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm">Vendedores</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['total_vendors'] }}</p>
                    </div>
                    <div class="bg-green-500/20 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-xl p-5 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm">Pedidos Pendientes</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['pending_orders'] }}</p>
                    </div>
                    <div class="bg-yellow-500/20 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accesos Rápidos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/20">
                <h3 class="text-xl font-bold text-white mb-4">Gestión Rápida</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.users') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-lg text-center transition">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Usuarios
                    </a>
                    <a href="{{ route('products.index') }}" class="bg-green-600 hover:bg-green-700 text-white p-4 rounded-lg text-center transition">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Productos
                    </a>
                    <a href="{{ route('categories.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white p-4 rounded-lg text-center transition">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Categorías
                    </a>
                    <a href="{{ route('orders.index') }}" class="bg-orange-600 hover:bg-orange-700 text-white p-4 rounded-lg text-center transition">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Pedidos
                    </a>
                    <a href="{{ route('admin.sales') }}" class="bg-teal-600 hover:bg-teal-700 text-white p-4 rounded-lg text-center transition col-span-2">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Historial de Ventas
                    </a>
                </div>
            </div>

            <!-- Usuarios Recientes -->
            <div class="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/20">
                <h3 class="text-xl font-bold text-white mb-4">Usuarios Recientes</h3>
                <div class="space-y-3">
                    @forelse($recent_users as $user)
                    <div class="flex items-center justify-between bg-white/5 rounded-lg p-3">
                        <div class="flex items-center">
                            <div class="bg-gray-600 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-white font-medium">{{ $user->name }}</p>
                                <p class="text-gray-400 text-sm">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 rounded text-xs font-medium
                            @if($user->role === 'admin') bg-red-500/20 text-red-300
                            @elseif($user->role === 'vendedor') bg-green-500/20 text-green-300
                            @else bg-blue-500/20 text-blue-300 @endif">
                            {{ ucfirst($user->role ?? 'cliente') }}
                        </span>
                    </div>
                    @empty
                    <p class="text-gray-400 text-center">No hay usuarios recientes</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Pedidos Recientes -->
        <div class="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/20">
            <h3 class="text-xl font-bold text-white mb-4">Pedidos Recientes</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-gray-300 text-left border-b border-white/10">
                            <th class="pb-3">ID</th>
                            <th class="pb-3">Cliente</th>
                            <th class="pb-3">Total</th>
                            <th class="pb-3">Estado</th>
                            <th class="pb-3">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_orders as $order)
                        <tr class="border-b border-white/5 text-gray-200">
                            <td class="py-3">#{{ $order->id }}</td>
                            <td class="py-3">{{ $order->user->name ?? 'N/A' }}</td>
                            <td class="py-3 font-semibold">S/ {{ number_format($order->total, 2) }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    @if($order->status === 'pendiente') bg-yellow-500/20 text-yellow-300
                                    @elseif($order->status === 'confirmado') bg-blue-500/20 text-blue-300
                                    @elseif($order->status === 'enviado') bg-purple-500/20 text-purple-300
                                    @elseif($order->status === 'entregado') bg-green-500/20 text-green-300
                                    @else bg-red-500/20 text-red-300 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-3 text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-400">No hay pedidos recientes</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection