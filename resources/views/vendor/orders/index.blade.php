@extends('layouts.app-simple')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-900 via-teal-800 to-blue-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">Pedidos Recibidos</h1>
                <p class="text-gray-300">Pedidos que incluyen tus productos</p>
            </div>
            <a href="{{ route('vendor.dashboard') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition">
                ← Dashboard
            </a>
        </div>

        <!-- Tabla de Pedidos -->
        <div class="bg-white/10 backdrop-blur rounded-xl border border-white/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-white/5">
                        <tr class="text-gray-300 text-left">
                            <th class="px-6 py-4">N° Orden</th>
                            <th class="px-6 py-4">Cliente</th>
                            <th class="px-6 py-4">Mis Productos</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr class="border-b border-white/5 text-gray-200 hover:bg-white/5">
                            <td class="px-6 py-4 font-mono font-bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4">
                                <p class="font-medium">{{ $order->user->name ?? 'N/A' }}</p>
                                <p class="text-gray-400 text-sm">{{ $order->user->email ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @foreach($order->products->where('user_id', Auth::id()) as $product)
                                <div class="text-sm mb-1">
                                    <span class="text-white">{{ $product->name }}</span>
                                    <span class="text-gray-400">(x{{ $product->pivot->quantity }})</span>
                                    <span class="text-green-400">S/ {{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</span>
                                </div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($order->status === 'pendiente') bg-yellow-500/30 text-yellow-300
                                    @elseif($order->status === 'confirmado') bg-blue-500/30 text-blue-300
                                    @elseif($order->status === 'enviado') bg-purple-500/30 text-purple-300
                                    @elseif($order->status === 'entregado') bg-green-500/30 text-green-300
                                    @else bg-red-500/30 text-red-300 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="text-gray-400">No tienes pedidos aún</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>

    </div>
</div>
@endsection