<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_email' => 'required|email',
            'shipping_address' => 'required|string',
            'shipping_district' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_zipcode' => 'nullable|string|max:10',
            'shipping_reference' => 'nullable|string',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $shippingAddress = $validated['shipping_address'] . ', ' . 
                             $validated['shipping_district'] . ', ' . 
                             $validated['shipping_city'];

            if (!empty($validated['shipping_zipcode'])) {
                $shippingAddress .= ' - CP: ' . $validated['shipping_zipcode'];
            }

            if (!empty($validated['shipping_reference'])) {
                $shippingAddress .= ' (Ref: ' . $validated['shipping_reference'] . ')';
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pendiente',
                'shipping_address' => $shippingAddress,
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::find($productId);
                
                if (!$product) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Producto no encontrado');
                }

                if ($product->stock < $item['quantity']) {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Stock insuficiente para {$product->name}");
                }

                $order->products()->attach($productId, [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    public function success($orderId)
    {
        $order = Order::with('products')->findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }
}