<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Home;
use App\Http\Controllers\Frontend\Cart;
use App\Http\Controllers\Frontend\Client;
use App\Http\Controllers\Frontend\Payment;

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

Route::view('/mail', 'frontend.emails.verify');

Route::get('/payment/form', [Payment::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment/finalize', [Payment::class, 'finalizePayment'])->name('payment.finalize');

Route::controller(Client::class)->group(function () {
  Route::get('/Iniciar_sesion', 'index')->name('client.login');
  Route::get('/Registrate', 'create')->name('client.register');
  Route::get('/Perfil', [Client::class, 'show'])->name('client.profile');
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
