<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegistration;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\DomainControll;
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
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/logout', [LoginRegistration::class, 'logout'])->name('logout');

Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
//});

Route::prefix('/admin')->group(function(){
    Route::get('/index', [Dashboard::class, 'index'])->name('admin.dashboard');
    Route::get('/domains/index', [DomainControll::class, 'index'])->name('admin.domain');
});
