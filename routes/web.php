<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');


Route::get('/login', function() {
    return view('auth.login');
})->name('login');


Route::post('c /login', function () {
    return redirect()->route('admin.dashboard');
})->name('login.store');


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
