<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-8 text-blue-400">🛒 Tu Carrito</h1>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-800 text-green-100 rounded border border-green-600">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-800 text-red-100 rounded border border-red-600">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
                @if(session('cart'))
                    <table class="w-full text-left mb-6">
                        <thead>
                            <tr class="text-gray-400 border-b border-gray-600">
                                <th class="p-4">Producto</th>
                                <th class="p-4 text-center">Precio</th>
                                <th class="p-4 text-center">Cant.</th>
                                <th class="p-4 text-center">Subtotal</th>
                                <th class="p-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr class="border-b border-gray-700">
                                    <td class="p-4 font-bold">{{ $details['name'] }}</td>
                                    <td class="p-4 text-center text-green-400">S/ {{ $details['price'] }}</td>
                                    <td class="p-4 text-center">{{ $details['quantity'] }}</td>
                                    <td class="p-4 text-center font-bold text-green-400">S/ {{ $details['price'] * $details['quantity'] }}</td>
                                    <td class="p-4 text-center">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button class="text-red-400 hover:text-red-300">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex justify-between items-center mt-6">
                        <div class="text-2xl font-bold">Total: <span class="text-green-400">S/ {{ number_format($total, 2) }}</span></div>
                        
                        <!-- AQUÍ ESTÁ EL BOTÓN OBLIGATORIO -->
                        <!-- Este formulario envía los datos al OrderController@store -->
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 rounded-lg font-bold text-white shadow-lg transform hover:scale-105 transition">
                                ✅ Confirmar Compra
                            </button>
                        </form>
                        <!-- FIN DEL BOTÓN -->

                    </div>
                @else
                    <div class="text-center py-10">
                        <p class="text-gray-400 text-lg mb-4">Tu carrito está vacío.</p>
                        <a href="{{ url('/') }}" class="text-blue-400 underline">Ir a comprar productos</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>