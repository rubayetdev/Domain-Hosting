<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegistration;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/', function () {
    return view('welcome');
})->name('register');

Route::get('/login', [LoginRegistration::class, 'index'])->name('login');

Route::post('/logged',[LoginRegistration::class, 'loggedIn'])->name('logged');

Route::post('/register',[LoginRegistration::class,'store'])->name('registration');

Route::get('/email/verify', [LoginRegistration::class, 'verifyEmail'])->name('verification.notice')->middleware('auth');

Route::get('/email/verify/{id}/{hash}', [LoginRegistration::class, 'emailVerification'])->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification',[LoginRegistration::class,'resendEmailLink'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginRegistration::class, 'logout'])->name('logout');
//});
