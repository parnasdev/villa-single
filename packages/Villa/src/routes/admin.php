<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
|
|
*/

use Illuminate\Support\Facades\Route;

Route::prefix('villa')->name('villa.')->group(function () {
    Route::get('/list', \Packages\Villa\src\Http\Livewire\Admin\ListPage::class)->name('list');
    Route::get('/add', \Packages\Villa\src\Http\Livewire\Admin\AddPage::class)->name('add');
    Route::get('/reserves', \Packages\Villa\src\Http\Livewire\Admin\ReservesPage::class)->name('reserves');
    Route::get('/reserve-info/{reserve}', \Packages\Villa\src\Http\Livewire\Admin\ReserveInfo::class)->name('reserves-info');
    Route::get('/edit/{residence}',\Packages\Villa\src\Http\Livewire\Admin\EditPage::class)->name('edit');
    Route::get('/priceManagement/{residence}',\Packages\Villa\src\Http\Livewire\Admin\PriceManagement::class)->name('priceManagement');

    Route::get('/my-reserves', \Packages\Villa\src\Http\Livewire\Admin\ReservesPanel::class)->name('my-reserves');
    Route::get('/my-reserve-info/{reserve}', \Packages\Villa\src\Http\Livewire\Admin\ReserveInfoPanel::class)->name('my-reserve-info');
});
