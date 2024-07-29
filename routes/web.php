<?php

use Illuminate\Support\Facades\Route;
use YourName\AlfaBank\Http\Controllers\PaymentController;

Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');