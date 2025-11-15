<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Muestra la lista de productos (Vista 'Read').
    public function index()
    {
        // Solamente con la relación 'category'
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    // Muestra el formulario para crear un nuevo producto (Vista 'Create').
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Guarda el nuevo producto en la base de datos (Lógica 'Create').
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Producto creado exitosamente.');
    }

    // Muestra un producto específico (Vista 'Read' individual, opcional).
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Muestra el formulario para editar un producto (Vista 'Update').
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Actualiza el producto en la base de datos (Lógica 'Update').
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Producto actualizado exitosamente.');
    }

    // Elimina un producto (Lógica 'Delete').
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Producto eliminado exitosamente.');
    }
}
