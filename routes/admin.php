<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Admin\UserController;

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



Route::get('/', [AuthController::class, 'index'])->name('admin.login');
Route::post('/auth', [AuthController::class, 'authenticate'])->name('admin.login.post');

// Rutas protegidas por autenticación
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


    Route::controller(CategoriesController::class)->group(function ($route) {

        Route::get('/Categorias', 'index')->name('Categorias');
        Route::get('/getAllCategories', 'selectCategory');
        Route::post('/insertCategory', 'new');
        Route::get('/getCategories', 'show');
        Route::post('/updateCategory', 'update');
        Route::post('/updateStatus', 'updateStatus');
    });

    Route::controller(SubCategoriesController::class)->group(function ($route) {

        Route::get('/SubCategorias', 'index')->name('SubCategorias');
        Route::get('/getSubCategories', 'show');
        Route::post('/insertSubCategory', 'new');
        Route::post('/updateSubCategory', 'update');
        Route::post('/updateStatusSub', 'updateStatus');
        Route::post('/selectSubCat', 'selectSubCategory');
    });

    Route::controller(ProductsController::class)->group(function ($route) {

        Route::get('productos', 'index')->name('products.index');
        Route::get('tableProducts', 'show');
        Route::post('newProduct', 'store');
        Route::post('editProduct', 'update');
        Route::post('/selectProduct', 'selectProduct');
    });

    Route::controller(CalendarController::class)->group(function ($route) {

        Route::get('calendario', 'index')->name('calendar.index');
        Route::get('schemaEvents','show');
        Route::post('insertHours', 'store');
    });

    Route::resource('Usuarios', UserController::class)->names('admin.users');
});
