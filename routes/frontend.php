<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Home;
use App\Http\Controllers\Frontend\Cart;

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

Route::get('/', [Home::class, 'index'])->name('home.index');

Route::controller(Cart::class)->group(function () {
  Route::get('/Carrito/{subcategory}', 'index');
  Route::get('/updateUI/{product}/{date}', 'show');
});
