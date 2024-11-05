<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegistration;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register',[LoginRegistration::class,'store'])->name('registration');
