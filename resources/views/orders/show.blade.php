<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen text-white">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Botón volver -->
            <a href="{{ route('orders.index') }}" class="mb-4 inline-block text-gray-400 hover:text-white transition">
                &larr; Volver a la lista
            </a>

            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-700 p-6">
                
                <!-- Encabezado de la Orden -->
                <div class="flex justify-between items-start border-b border-gray-700 pb-6 mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-blue-400">Orden #{{ $order->id }}</h1>
                        <p class="text-sm text-gray-400">Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Estado</p>
                        <span class="px-3 py-1 rounded text-sm font-bold bg-blue-900 text-blue-200 uppercase">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>

                <!-- Lista de Productos -->
                <h3 class="text-lg font-semibold mb-4 text-gray-200">Productos Comprados</h3>
                <div class="space-y-4">
                    @foreach($order->products as $product)
                    <div class="flex justify-between items-center bg-gray-700/50 p-4 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <!-- Si tienes imagen, descomenta esto: -->
                            <!-- <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded"> -->
                            <div>
                                <h4 class="font-bold">{{ $product->name }}</h4>
                                <p class="text-sm text-gray-400">Cantidad: {{ $product->pivot->quantity }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-green-400">S/ {{ number_format($product->pivot->price, 2) }}</p>
                            <p class="text-xs text-gray-500">Unitario</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Total Final -->
                <div class="mt-8 pt-6 border-t border-gray-700 flex justify-between items-center">
                    <span class="text-xl font-bold text-gray-300">Total Pagado</span>
                    <span class="text-3xl font-bold text-green-400">S/ {{ number_format($order->total, 2) }}</span>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>