<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('pages.home');
});

//Route::get('/register', function () {
    //return view('pages.register');
//})->name('register.view');

Route::get('/login', function () {
    return view('pages.login');
})->name('login'); //geeft het een naam anders kan het niet opgeroepen worden


//Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/login', [UserController::class, 'login'])->name('login');

//REGISTER 
Route::get('/register/step1', function () {
    return view('pages.register.step1');
})->name('register.step1');

Route::post('/register/step1', [RegisterController::class, 'storeStep1'])
->name('register.step1.store');

Route::get('/register/step2', function () {
    return view('pages.register.step2');
})->name('register.step2');

Route::post('/register/step2', [RegisterController::class, 'storeStep2'])
->name('register.step2.store');

Route::get('/register/step3', function () {
    return view('pages.register.step3');
})->name('register.step3');

Route::post('/register/step3', [RegisterController::class, 'storeStep3'])
->name('register.step3.store');