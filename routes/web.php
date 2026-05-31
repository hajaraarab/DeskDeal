<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
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

Route::get('/login', [RegisterController::class, 'showLogin'])->name('login');
Route::post('/login', [RegisterController::class, 'login']);

Route::get('/register', [RegisterController::class, 'show'])
    ->name('register.form');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register');

Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');