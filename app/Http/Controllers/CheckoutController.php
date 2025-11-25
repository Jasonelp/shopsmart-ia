<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Muestra la lista de órdenes (El 3er CRUD que te piden)
    public function index()
    {
        $user = Auth::user();

        // Admin y Vendedor ven todo (simplificado para el proyecto)
        if ($user->role === 'admin' || $user->role === 'vendedor') {
            $orders = Order::with(['user', 'products'])->latest()->paginate(10);
        } else {
            // Cliente solo ve SUS órdenes
            $orders = Order::where('user_id', $user->id)
                           ->with(['products'])
                           ->latest()
                           ->paginate(10);
        }

        return view('orders.index', compact('orders'));
    }

    // Procesa la compra cuando das click en "Confirmar"
    public function placeOrder(Request $request)
    {
        // 1. Validar usuario logueado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para comprar.');
        }

        // 2. Obtener carrito (Asumiendo que usas session 'cart')
        $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Tu carrito está vacío.');
        }

        // 3. Calcular total
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // 4. Iniciar transacción (Guarda todo o nada)
        try {
            DB::beginTransaction();

            // Crear la Orden
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pendiente',
                'shipping_address' => $request->input('address', 'Dirección Principal'),
                'notes' => $request->input('notes', '')
            ]);

            // Guardar detalles y restar stock
            foreach ($cart as $id => $details) {
                $product = Product::find($id);
                
                // Validación de Stock (Importante para la nota)
                if ($product->stock < $details['quantity']) {
                    throw new \Exception("El producto " . $product->name . " no tiene suficiente stock.");
                }

                // Guardar en tabla intermedia
                $order->products()->attach($id, [
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);

                // Restar del inventario
                $product->decrement('stock', $details['quantity']);
            }

            // Vaciar carrito
            session()->forget('cart');
            
            DB::commit(); // Confirmar cambios en BD

            return redirect()->route('orders.index')->with('success', '¡Orden realizada con éxito!');

        } catch (\Exception $e) {
            DB::rollBack(); // Deshacer cambios si hay error
            return redirect()->back()->with('error', 'Error al procesar: ' . $e->getMessage());
        }
    }
}