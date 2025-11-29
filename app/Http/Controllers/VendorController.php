<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        $my_products = Product::where('user_id', $user->id)->latest()->get();
        
        $my_orders = Order::whereHas('products', function($q) use ($user) {
            $q->where('products.user_id', $user->id);
        })->with('user')->latest()->take(10)->get();

        $stats = [
            'my_products' => $my_products->count(),
            'pending_orders' => Order::whereHas('products', function($q) use ($user) {
                $q->where('products.user_id', $user->id);
            })->where('status', 'pendiente')->count(),
        ];

        return view('vendor.dashboard', compact('stats', 'my_products', 'my_orders'));
    }

    public function products()
    {
        $products = Product::where('user_id', Auth::id())
                          ->with('category')
                          ->orderBy('created_at', 'desc')
                          ->paginate(10);
        
        $categories = Category::all();
        
        return view('vendor.products.index', compact('products', 'categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = Auth::id();

        Product::create($validated);

        return redirect()->route('vendor.products')->with('success', 'Producto creado exitosamente');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string|max:500',
        ]);

        $product->update($validated);

        return redirect()->route('vendor.products')->with('success', 'Producto actualizado');
    }

    public function destroyProduct($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        $product->delete();

        return redirect()->route('vendor.products')->with('success', 'Producto eliminado');
    }

    public function orders()
    {
        $orders = Order::whereHas('products', function($q) {
            $q->where('products.user_id', Auth::id());
        })->with(['user', 'products'])->latest()->paginate(10);

        return view('vendor.orders.index', compact('orders'));
    }
}