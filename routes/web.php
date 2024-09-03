<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
Route::get('/',[PageController::class,'index'])->name('main');
Route::post('/register',[RegisterController::class,'register'])->name('register');
Route::get('/registration-success',[PageController::class,'registrationSuccess'])->name('registration.success');