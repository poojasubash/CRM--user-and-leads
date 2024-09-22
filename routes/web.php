<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\masters\TagController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Masters\SourceController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Masters\GroupController;

// Login routes
Route::get('/login', function () {
         return view('auth.login');
    })->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// OTP verification after login
Route::get('login/verify-otp', function () {
         return view('auth.verify-otp');
    })->name('login.verify.otp');
Route::post('login/verify-otp', [LoginController::class, 'verifyOtp'])->name('login.verify.otp');


// Registration Routes
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
Route::get('register/2fa', [RegisterController::class, 'showTwoFactorSetup'])->name('register.2fa');
Route::post('register/complete', [RegisterController::class, 'completeRegistration'])->name('register.complete');

// OTP Verification Route
// Route::get('verify-otp', function () {
//     return view('auth.verify-otp');
// })->name('verify.otp');

// Route::post('verify-otp', [RegisterController::class, 'verifyOtp'])->name('verify.otp');

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Logout Route
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resource Routes
    Route::resource('leads', LeadController::class);
    route::patch('/leads/{lead}/update-status', [LeadController::class, 'updateStatus'])->name('leads.updateStatus');
    Route::resource('users', UserController::class);

    // Source routes
    Route::resource('masters/source', SourceController::class)->names([
        'index' => 'masters.source.index',
        'store' => 'masters.source.store',
        'update' => 'masters.source.update',
        'destroy' => 'masters.source.destroy',
    ]);

    //groups routes
    Route::resource('masters/groups',GroupController::class)->names([
        'index' =>'masters.groups.index',
        'store'=>'masters.groups.store',
        'update'=>'masters.groups.update',
        'destroy'=>'masters.groups.destroy',
    ]);

    //Tag routes
    Route::resource('masters/tags',TagController::class)->names([
        'index' =>'masters.tags.index',
        'store'=>'masters.tags.store',
        'update'=>'masters.tags.update',
        'destroy'=>'masters.tags.destroy',
    ]);

});
