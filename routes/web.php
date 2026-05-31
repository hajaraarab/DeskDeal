<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/marketplace', function () {
    return view('marketplace');
})->name('marketplace');

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
