<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthenticationController;
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

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| These routes handle user authentication, including login, registration,
| password reset, and email verification if enabled. They are loaded by
| the RouteServiceProvider and assigned to the "web" middleware group.
|
*/

// Login Routes
Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);

// Logout Route
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [AuthenticationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register']);

// Password Reset Routes
Route::get('/password/reset', [AuthenticationController::class, 'showPasswordResetForm'])->name('password.request');
Route::post('/password/email', [AuthenticationController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthenticationController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthenticationController::class, 'resetPassword'])->name('password.update');

// Email Verification Routes (if used)
Route::get('/email/verify', [AuthenticationController::class, 'showEmailVerificationNotice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthenticationController::class, 'verifyEmail'])->name('verification.verify');
Route::post('/email/resend', [AuthenticationController::class, 'resendVerificationEmail'])->name('verification.resend');

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
|
*/

Route::get('', fn() => view('products.index'));
Route::get('/', fn() => view('products.index'))->name('home');

/*
|--------------------------------------------------------------------------
| Product and Cart Routes
|--------------------------------------------------------------------------
|
*/

Route::resource('products', ProductController::class)
	->only(['index', 'show']);

Route::resource('cart', CartController::class)
    ->only(['create', 'store']);
