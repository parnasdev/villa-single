<?php

use Illuminate\Support\Facades\Route;

Route::prefix('payments')->name('payments.')->middleware(['auth:web' , 'role_access:panel'])->group(function () {
    Route::get('/' , \Packages\pay\src\Http\Livewire\Admin\TransactionIndex::class)->name('index')->middleware('can:payments.read');
    Route::get('/setting' , \Packages\pay\src\Http\Livewire\Admin\PaymentSetting::class)->name('setting')->middleware('can:payments.setting');
});
