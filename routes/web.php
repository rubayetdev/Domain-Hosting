<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegistration;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderDomain;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\DomainControll;
use App\Http\Controllers\Admin\ManageDomain;
use App\Http\Controllers\UddoktapayController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Middleware\AdminSession;

//Route::withoutMiddleware([AdminSession::class])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('register');

    Route::get('/login', [LoginRegistration::class, 'index'])->name('login');

    Route::post('/logged',[LoginRegistration::class, 'loggedIn'])->name('logged');

    Route::post('/register',[LoginRegistration::class,'store'])->name('registration');

    Route::get('/email/verify', [LoginRegistration::class, 'verifyEmail'])->name('verification.notice')->middleware('auth');

    Route::get('/email/verify/{id}/{hash}', [LoginRegistration::class, 'emailVerification'])->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification',[LoginRegistration::class,'resendEmailLink'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//});
//Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/logout', [LoginRegistration::class, 'logout'])->name('logout');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/order',[OrderDomain::class, 'index'])->name('order');
    Route::get('/order/{id}',[OrderDomain::class,'show'])->name('order.show');
    Route::post('/order/store',[OrderDomain::class,'store'])->name('order.store');

    Route::post( 'pay', [UddoktapayController::class, 'pay'] )->name( 'uddoktapay.pay' );
    Route::get( 'success', [UddoktapayController::class, 'success'] )->name( 'uddoktapay.success' );
    Route::get( 'cancel', [UddoktapayController::class, 'cancel'] )->name( 'uddoktapay.cancel' );
    Route::post( 'webhook', [UddoktapayController::class, 'webhook'] )->name( 'uddoktapay.webhook' );
//});

Route::prefix('/admin')->group(function(){
    Route::get('/index', [Dashboard::class, 'index'])->name('admin.dashboard');
    Route::get('/domains/index', [DomainControll::class, 'index'])->name('admin.domain');
    Route::post('/domains/create', [DomainControll::class, 'create'])->name('admin.domain.create');
    Route::get('/domains/store', [DomainControll::class, 'store'])->name('admin.domain.store');
    Route::get('/domains/show/{id}', [DomainControll::class, 'show'])->name('admin.domain.show');
    Route::put('/domains/update/{id}', [DomainControll::class, 'update'])->name('admin.domain.update');
    Route::delete('/domains/destroy/{id}', [DomainControll::class, 'destroy'])->name('admin.domain.destroy');
    Route::get('/domains/manageDomain/{id}',[ManageDomain::class,'index'])->name('admin.domain.manage');
    Route::get('/customer/customerList',[ManageDomain::class,'customerList'])->name('admin.customer.list');
    Route::post('/logout', [LoginRegistration::class, 'adminLogout'])->name('admin.logout');
});
