<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
})->name('home');


Route::get('/login', function() {
    return view('auth.login');
})->name('login');


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

