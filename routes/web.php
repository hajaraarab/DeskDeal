<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProfileController::class, 'home'])
    ->name('home');

Route::get('/about', function () {
    return view('about', [
        'registeredUsers' => User::count(),
        'completedOrders' => Order::whereIn('status', ['done', 'completed'])->count(),
        'activeProducts' => Product::where('status', 'available')->count(),
    ]);
})->name('about');

Route::get('/marketplace', [ProductController::class, 'index'])
    ->name('marketplace');

Route::get('/marketplace/create', [ProductController::class, 'create'])
    ->middleware('auth')
    ->name('products.create');

Route::post('/marketplace', [ProductController::class, 'store'])
    ->middleware('auth')
    ->name('products.store');

Route::get('/marketplace/filter', [ProductController::class, 'filter'])
    ->name('marketplace.filter');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

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


Route::middleware('auth')->group(function () {

    Route::get(
        '/products/{product}/reserve',
        [ReservationController::class, 'create']
    )->name('reservations.create');

    Route::post(
        '/products/{product}/reserve',
        [ReservationController::class, 'store']
    )->name('reservations.store');

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

});

Route::patch('/reservations/{reservation}/accept', [ReservationController::class, 'accept'])
->name('reservations.accept');

Route::patch('/reservations/{reservation}/reject', [ReservationController::class, 'reject'])
    ->name('reservations.reject');

Route::get('/reservations/{reservation}/checkout', [ReservationController::class, 'checkout'])
    ->name('reservations.checkout');

Route::get('/reservations', [ReservationController::class, 'index'])
    ->name('reservations.index');


Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->name('products.edit');

Route::patch('/products/{product}', [ProductController::class, 'update'])
    ->name('products.update');

Route::post(
    '/reservation/{reservation}/appointment',
    [ReservationController::class, 'storeAppointment']
)->name('reservation.appointment');

Route::post(
    '/reservation/{reservation}/appointment-preview',
    [ReservationController::class, 'appointmentPreview']
)->name('reservation.appointment.preview');

Route::post(
    '/reservations/{reservation}/make',
    [ReservationController::class, 'confirmAppointment']
)->name('reservation.make');

Route::get(
    '/reservations/{reservation}/completed',
    [ReservationController::class, 'make']
)->name('reservation.completed');

Route::get('/mijn-producten', [ProductController::class, 'myProducts'])
    ->middleware('auth')
    ->name('products.mine');

Route::get(
    '/orders/{order}/reschedule',
    [OrderController::class, 'reschedule']
)->name('orders.reschedule');

Route::post(
    '/orders/{order}/reschedule',
    [OrderController::class, 'storeReschedule']
)->name('orders.reschedule.store');

Route::get(
    '/orders/{order}/reschedule/confirm',
    [OrderController::class, 'rescheduleConfirm']
)->name('orders.reschedule.confirm');

Route::post('/contact', [ContactController::class, 'send'])
    ->name('contact.send');