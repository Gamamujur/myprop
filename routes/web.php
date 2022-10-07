<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

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

Route::get('/',[FrontController::class,'index'])->name('index');
Route::get('details/{slug}', [FrontController::class,'details'])->name('details');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('cart', [FrontController::class,'cart'])->name('cart');
    Route::get('/checkout/success', [FrontController::class,'success'])->name('checkout-success');
    Route::post('/checkout', [FrontController::class,'checkout'])->name('checkout');
    Route::post('logs',[FrontController::class,'logs'])->name('logs');
    
    Route::post('/cart/{id}',[FrontController::class,'cartAdd'])->name('cart-add');
    Route::delete('/cart/{id}',[FrontController::class,'cartDel'])->name('cart-delete');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->name('dashboard.')->prefix('dashboard')
->group(function () {
    
    Route::get('/', [DashboardController::class,'index'])->name('index');

    Route::middleware(['isAdmin'])->group(function () {
        Route::resource('product', ProductController::class);
        Route::resource('product.gallery', ProductGalleryController::class)->shallow()->only([
            'index','create','store','destroy'
        ]);
        Route::resource('transaction', TransactionController::class)->only([
            'index','show','edit','update'
        ]);
        Route::resource('user', UserController::class)->only([
            'index','edit','update','destroy'
        ]);
    });
});
