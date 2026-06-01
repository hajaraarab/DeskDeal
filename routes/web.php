<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/marketplace', [ProductController::class, 'index'])
    ->name('marketplace');

Route::get('/marketplace/create', [ProductController::class, 'create'])
    ->middleware('auth')
    ->name('products.create');

Route::post('/marketplace', [ProductController::class, 'store'])
    ->middleware('auth')
    ->name('products.store');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/register', [RegisterController::class, 'show'])
    ->name('register.form');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register');

Route::get('/login', [LoginController::class, 'show'])
    ->name('login.form');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');
