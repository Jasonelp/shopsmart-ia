<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminOnly;

// Home personalizado (panel de bienvenida)
Route::get('/', function () {
    return view('home');
});

// Dashboard (puedes dejarlo protegido si deseas)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas solo para admins (CRUD real)
Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    // Route::resource('orders', OrderController::class); // solo si usas pedidos
});

// Rutas para perfil de usuario (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autenticación Breeze (login, register, etc)
require __DIR__.'/auth.php';
