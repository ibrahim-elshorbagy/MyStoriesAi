<?php

use App\Http\Controllers\Admin\Order\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('/dashboard')->group(function () {
  // Orders routes
  Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
  Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
});
