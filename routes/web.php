<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ClientController;

// ========== RUTAS PÚBLICAS ==========
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/productos', [ProductController::class, 'publicIndex'])->name('products.public.index');
Route::get('/producto/{id}', [ProductController::class, 'publicShow'])->name('products.public.show');
Route::get('/categorias', [CategoryController::class, 'publicIndex'])->name('categories.public.index');
Route::get('/categoria/{id}', [CategoryController::class, 'publicShow'])->name('categories.public.show');

// ========== RUTAS IA ==========
Route::get('/ai/test', [AIController::class, 'test'])->name('ai.test');              // TEST IA
Route::post('/ai/chat', [AIController::class, 'chat'])->name('ai.chat');            // CHAT IA
Route::get('/ai/product/{id}', [AIController::class, 'productAnalysis'])->name('ai.product');  // ANALIZAR PRODUCTO
Route::post('/ai/vision', [AIController::class, 'vision'])->name('ai.vision');      // VISIÓN IA

// ========== RUTAS AUTENTICADAS (TODOS LOS USUARIOS) ==========
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard inteligente - redirige según rol
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'vendedor') {
            return redirect()->route('vendor.dashboard');
        } else {
            return redirect()->route('client.dashboard');
        }
    })->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Carrito
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add_to_cart');
    Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Mis pedidos (cliente)
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my-orders');

    // Reviews
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// ========== RUTAS CLIENTE ==========
Route::middleware(['auth'])->prefix('cliente')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
});

// ========== RUTAS VENDEDOR ==========
Route::middleware(['auth', 'vendor'])->prefix('vendedor')->group(function () {
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
    Route::get('/productos', [VendorController::class, 'products'])->name('vendor.products');
    Route::post('/productos', [VendorController::class, 'storeProduct'])->name('vendor.products.store');
    Route::put('/productos/{id}', [VendorController::class, 'updateProduct'])->name('vendor.products.update');
    Route::delete('/productos/{id}', [VendorController::class, 'destroyProduct'])->name('vendor.products.destroy');
    Route::get('/pedidos', [VendorController::class, 'orders'])->name('vendor.orders');
});

// ========== RUTAS ADMIN ==========
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/usuarios', [AdminController::class, 'users'])->name('admin.users');
    Route::put('/usuarios/{id}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.updateRole');
    Route::delete('/usuarios/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/ventas', [AdminController::class, 'salesHistory'])->name('admin.sales');

    // CRUDs Admin
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
});

require __DIR__.'/auth.php';
