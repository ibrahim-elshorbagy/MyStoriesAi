<?php

use App\Http\Controllers\User\Order\UserOrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/user/orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('/user/orders/{order}', [UserOrderController::class, 'show'])->name('user.orders.show');
});