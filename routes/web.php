<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas del Carrito
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add_to_cart');
    Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');

    // Mis Pedidos
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my-orders');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Reviews
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// ========== RUTAS DE ADMIN ==========

Route::middleware(['auth', AdminOnly::class])->prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
});

// Autenticación Breeze
require __DIR__.'/auth.php';