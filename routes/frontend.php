<?php

use App\Http\Controllers\Frontend\Booking;
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

Route::controller(Client::class)->group(function () {
  Route::get('/Iniciar_sesion', 'index')->name('client.login');
  Route::get('/Registrate', 'create')->name('client.register');
  Route::get('/Perfil', 'show')->name('client.profile');
  Route::get('/Registro', 'create')->name('registro');
  Route::get('/verify', 'verifyEmail');
});

Route::controller(Cart::class)->group(function () {
  Route::get('/Carrito/{subcategory}', 'index');
  Route::get('/updateUI/{subcategory}/{date}', 'show');
  Route::post('updateGuests', 'guests');
  Route::post('/cartsession', 'cartData');
  Route::post('/billingsession', 'billingData');
  Route::get('/sesiones', 'showSession');
  Route::post('/getBtnPayment', 'paymentData');
});

Route::controller(Booking::class)->group(function () {
  Route::post('/Reserva', 'summaryPayment');
  Route::get('/Correo', 'email');
});