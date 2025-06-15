<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
// Cart routes
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Sử dụng middleware 'guest' cho các route đăng nhập/đăng ký
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('guest');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register')
    ->middleware('guest');

Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');
// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Feedback routes
    Route::prefix('feedback')->group(function () {
        Route::get('/', [FeedbackController::class, 'create'])->name('feedback.create');
        Route::post('/', [FeedbackController::class, 'store'])->name('feedback.store');
    });
    
    // User profile
    Route::prefix('user')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
        
        // User orders
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('user.orders.index');
            Route::get('/{order}', [OrderController::class, 'show'])->name('user.orders.show');
        });
    });
});

Route::prefix('admin')
    ->middleware(['auth']) // Tạm bỏ 'admin'
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    
    // Products management
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });
    
    // Orders management
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::post('/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    });
    
    // Feedbacks management
    Route::prefix('feedbacks')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('admin.feedbacks.index');
        Route::get('/{feedback}', [FeedbackController::class, 'show'])->name('admin.feedbacks.show');
        Route::delete('/{feedback}', [FeedbackController::class, 'destroy'])->name('admin.feedbacks.destroy');
    });
    
    // Users management
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('admin.users.make-admin');
    });
});

// Fallback route for 404 errors
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});







