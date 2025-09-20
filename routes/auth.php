<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

// Routes untuk guest (belum login)
Route::middleware('guest')->group(function () {

    // REGISTER
    Volt::route('register', 'pages.auth.register')->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');

    // LOGIN
    Volt::route('login', 'pages.auth.login')->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.post');

    // FORGOT PASSWORD
    Volt::route('forgot-password', 'pages.auth.forgot-password')->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // RESET PASSWORD
    Volt::route('reset-password/{token}', 'pages.auth.reset-password')->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Routes untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // VERIFY EMAIL
    Volt::route('verify-email', 'pages.auth.verify-email')->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    // CONFIRM PASSWORD
    Volt::route('confirm-password', 'pages.auth.confirm-password')->name('password.confirm');

    // LOGOUT
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
