<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Category::create($validated);
        return redirect()->route('categories.index')
                         ->with('success', 'Categoría creada exitosamente.');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $category = Category::findOrFail($id);
        $category->update($validated);
        return redirect()->route('categories.index')
                         ->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')
                         ->with('success', 'Categoría eliminada correctamente.');
    }
    public function publicIndex()
    {
        $categories = Category::withCount('products')->get();
        return view('categories.public-index', compact('categories'));
    }

    public function publicShow($id)
    {
        $category = Category::with('products')->findOrFail($id);
        return view('categories.public-show', compact('category'));
    }    
}

