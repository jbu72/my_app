<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::controller(AuthController::class)->group(function () {
    Route::get('inscription', 'index')->middleware(['auth', 'admin'])->name('register');
    Route::get('inscription', 'indexManager')->middleware(['auth', 'admin'])->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
// Route::post('register',[AuthController::class,'registerSave'])->name('register.save');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'search')->name('research');
        Route::get('', 'accueil')->name('products');
        Route::get('add', 'add')->name('products.add');
        Route::post('add', 'save')->name('products.save');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::post('edit/{id}', 'update')->name('products.update');
        Route::get('delete/{id}', 'delete')->name('products.delete');
        // Route::get('/get-product-details/{id}', 'ProductController@getProductDetails')->name('products.show');
    });
    Route::get('/details/{id}', [ProductController::class, 'getProductDetails'])->name('products.show');
    Route::post('/detai', [ProductController::class, 'test'])->name('search');

    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('/', 'accueil')->name('category');
        Route::get('add', 'add')->name('category.add');
        Route::post('add', 'save')->name('category.save');
        Route::post('save', 'save')->name('category.edit');
        Route::get('edit/{id}', 'edit')->name('category.edit');
        Route::post('edit/{id}', 'update')->name('category.update');
        Route::get('delete/{id}', 'delete')->name('category.delete');
    });
});
