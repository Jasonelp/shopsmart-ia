<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminOnly;

// ========== RUTAS PÚBLICAS ==========

// Home público
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catálogo público de productos
Route::get('/productos', [ProductController::class, 'publicIndex'])->name('products.public.index');
Route::get('/producto/{id}', [ProductController::class, 'publicShow'])->name('products.public.show');

// Categorías públicas
Route::get('/categorias', [CategoryController::class, 'publicIndex'])->name('categories.public.index');
Route::get('/categoria/{id}', [CategoryController::class, 'publicShow'])->name('categories.public.show');

// ========== RUTAS AUTENTICADAS ==========

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========== RUTAS DE ADMIN ==========

Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
});

// Autenticación Breeze
require __DIR__.'/auth.php';
