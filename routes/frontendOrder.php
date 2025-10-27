<?php

use App\Http\Controllers\Frontend\Order\OrderController;
use App\Http\Controllers\Frontend\PaymentGateways\PaymobController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:user'])->group(function () {
  // Single route to show the multi-step form
  Route::get('/create-order', [OrderController::class, 'create'])->name('frontend.order.create');

  // Single route to submit the complete order
  Route::post('/order/store', [OrderController::class, 'store'])->name('frontend.order.store');

  // Payment routes (keep these as before)
  Route::get('/orders/{order}/payment', [OrderController::class, 'payment'])->name('frontend.order.payment');
  Route::post('/orders/{order}/process-payment', [OrderController::class, 'processPayment'])->name('frontend.order.processPayment');

  // Paymob Payment Routes
  Route::get('/payment/paymob/success/{order?}', [PaymobController::class, 'success'])->name('frontend.payment.success');
  Route::get('/payment/paymob/failed/{order?}', [PaymobController::class, 'failure'])->name('frontend.payment.failed');
});
