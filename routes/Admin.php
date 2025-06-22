<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CartController, FeedbackController, HomeController,ProductController};
use App\Http\Controllers\Admin;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', Admin\ProductController::class);
    Route::resource('orders', Admin\OrderController::class);
    Route::resource('users', Admin\UserController::class);
    Route::resource('feedbacks', Admin\FeedbackController::class);
});