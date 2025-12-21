<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('register');
})->name('register.view');

Route::get('/login', function () {
    return view('login');
})->name('login'); //geeft het een naam anders kan het niet opgeroepen worden


Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'login'])->name('login');