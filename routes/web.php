<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/' , \App\Http\Livewire\Home\IndexPage::class);
Route::get('authenticate', \App\Http\Livewire\Home\Auth\AuthenticatePage::class)->name('login')->middleware('guest');
Route::get('be-host', \App\Http\Livewire\Home\Auth\AuthBeHost::class)->name('beHost');
Route::get('/profile', \App\Http\Livewire\Home\ProfilePage::class)->name('profile');