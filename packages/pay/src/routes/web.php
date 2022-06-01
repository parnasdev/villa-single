<?php
use Illuminate\Support\Facades\Route;
Route::get('/verify/{reserve}' , [\Packages\pay\src\Http\Controllers\PaymentController::class , 'callbackurl'])->name('pay.verify');
Route::get('/purchase/{reserve}' , [\Packages\pay\src\Http\Controllers\PaymentController::class , 'purchase'])->name('pay.purchase');

Route::prefix('user')->name('dashboard.')->middleware('auth:web')->group(function () {
    Route::get('/transactions' , \Packages\pay\src\Http\Livewire\Home\Dashboard\TransactionPage::class)->name('transactions');
});
