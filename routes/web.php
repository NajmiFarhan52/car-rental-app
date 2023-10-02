<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Landing Page
Route::get('/', function () {
    return view('welcome');
});

//Route to Login Page
Route::get('auth/login', function () {
    return view('auth/login');
})->name('auth.login');

//Authentication
Auth::routes();
Route::get('auth/home', [App\Http\Controllers\Auth\HomeController::class, 'index'])->name('auth.home')->middleware('admin');
Route::get('user/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');

//Cars resources
Route::resource('/cars', CarController::class)->middleware(['auth', 'verified']);

//Bookings resources
Route::get('/bookings/create/{car}', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/index', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
Route::patch('bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
