<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('main');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::get('/registration-success', [PageController::class, 'registrationSuccess'])->name('registration.success');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/')->with('successMessage', 'Your account is verified successfully.');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminPageController::class, 'index'])->name('dashboard');
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::delete('{user_id}', [UserController::class, 'delete'])->name('delete');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::get('edit/{user_id}',[AdminPageController::class,'editUser'])->name('edit');

    });
});Route::put('admin/users/{user}', [UserController::class, 'update'])->name('update');

Route::post('admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
