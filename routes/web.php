<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
Route::get('/',[PageController::class,'index'])->name('main');
Route::post('/register',[AuthenticationController::class,'register'])->name('register');
Route::get('/registration-success',[PageController::class,'registrationSuccess'])->name('registration.success');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/')->with('successMessage', 'Your account is verified successfully.');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/login',[AuthenticationController::class,'login'])->name('login');
Route::post('/logout',[AuthenticationController::class,'logout'])->name('logout');
