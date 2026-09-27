<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\ProductController;




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


    });

});


