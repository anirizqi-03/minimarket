<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\KasirController;
use App\Http\Controllers\Admin\TransactionController;



Route::get('/', function () {
    return view('customer.pages.index');
})->name('home');


// route sebelum login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

});


// route setelah login
Route::middleware('auth')->group(function (){
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');



    //khusus admin
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.pages.dashboard');
    })->name('dashboard');

    // Products CRUD
    Route::resource('products', ProductController::class);


    //Bagian Kasir
    Route::prefix('kasir')->name('kasir.')->group(function () {
        Route::get('/', [KasirController::class, 'index'])->name('index');
        Route::get('/search-product', [KasirController::class, 'searchProduct'])->name('search');
        Route::post('/store', [KasirController::class, 'store'])->name('store');
        Route::get('/receipt/{transaction}', [KasirController::class, 'receipt'])->name('receipt');
        });


    //riwayat transaksi
     Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/{transaction}', [TransactionController::class, 'show'])->name('show');
        Route::delete('/{transaction}', [TransactionController::class, 'destroy'])->name('destroy');
        });

    });


});


