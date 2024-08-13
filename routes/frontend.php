<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Home;
use App\Http\Controllers\Frontend\Cart;
use App\Http\Controllers\Frontend\Client;

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

Route::middleware(['client.auth'])->group(function () {
  Route::get('/Perfil', [Client::class, 'show']);
  // Otras rutas protegidas para clientes...
});

Route::controller(Cart::class)->group(function () {
  Route::get('/Carrito/{subcategory}', 'index');
  Route::get('/updateUI/{subcategory}/{date}', 'show');
  Route::post('updateGuests', 'guests');
});


Route::controller(Client::class)->group(function () {
  Route::get('/Registro', 'create')->name('registro');
  Route::get('/verify', 'verifyEmail');
});
