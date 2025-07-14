<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;

// Public routes
Route::get('/', [HomeController::class, 'home'])->name('home');

// Service routes (public)
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/fancy-paper', [ServiceController::class, 'fancyPaper'])->name('fancy-paper');
    Route::get('/packaging', [ServiceController::class, 'packaging'])->name('packaging');
    Route::get('/packaging-test', function() {
        return view('services.packaging-test');
    })->name('packaging-test');
    Route::get('/banner', [ServiceController::class, 'banner'])->name('banner');
    Route::get('/uv-printing', [ServiceController::class, 'uvPrinting'])->name('uv-printing');
    Route::post('/calculate-price', [ServiceController::class, 'calculatePrice'])->name('calculate-price');
    Route::post('/place-order', [ServiceController::class, 'placeOrder'])->name('place-order');
});

// Checkout routes (public)
Route::get('/checkout', [ServiceController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [ServiceController::class, 'storeOrderData'])->name('checkout.store');
Route::post('/checkout/process', [ServiceController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/success/{order}', [ServiceController::class, 'checkoutSuccess'])->name('checkout.success');

// Authentication routes
Auth::routes();

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    
    // Order management for customers
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my-orders');
    
    // Product CRUD (Admin only)
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/upload-photo', [ProductController::class, 'uploadPhoto'])->name('products.upload-photo');
    Route::delete('products/{product}/photos/{photo}', [ProductController::class, 'deletePhoto'])->name('products.delete-photo');
    
    // Category CRUD (Admin only)
    Route::resource('categories', CategoryController::class);
    
    // Customer CRUD (Admin only)
    Route::resource('customers', CustomerController::class);
    
    // Order CRUD (Admin only)
    Route::resource('orders', OrderController::class);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::patch('orders/{order}/payment', [OrderController::class, 'updatePayment'])->name('orders.update-payment');
});

// API routes for AJAX
Route::prefix('api')->middleware(['auth'])->group(function () {
    Route::get('products/search', [ProductController::class, 'search'])->name('api.products.search');
    Route::get('customers/search', [CustomerController::class, 'search'])->name('api.customers.search');
    Route::get('orders/stats', [OrderController::class, 'stats'])->name('api.orders.stats');
    Route::get('dashboard/stats', [HomeController::class, 'stats'])->name('api.dashboard.stats');
    Route::patch('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('api.categories.toggle-status');
});
