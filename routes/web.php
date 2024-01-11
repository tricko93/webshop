<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;

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
Route::get('/password/reset', [AuthenticationController::class, 'showPasswordResetForm'])
	->name('password.request');
Route::post('/password/email', [AuthenticationController::class, 'sendResetLinkEmail'])
	->name('password.email');
Route::get('/password/reset/{token}', [AuthenticationController::class, 'showResetForm'])
	->name('password.reset');
Route::post('/password/reset', [AuthenticationController::class, 'resetPassword'])
	->name('password.update');

// Email Verification Routes (if used)
Route::get('/email/verify', [AuthenticationController::class, 'showEmailVerificationNotice'])
	->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthenticationController::class, 'verifyEmail'])
    ->name('verification.verify')
    ->middleware(['web']);
Route::post('/email/resend', [AuthenticationController::class, 'resendVerificationEmail'])
    ->name('verification.resend')
    ->middleware('web');

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

/*
|--------------------------------------------------------------------------
| Profile and Account Settings Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth'])->group(function () {
    // Profile Page
    Route::get('/profile', [ProfileController::class, 'showProfile'])
    	->name('profile.show');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Settings Page
    Route::get('/settings', [SettingsController::class, 'showSettings'])
        ->name('settings.show');

    // Change Password
    Route::get('/settings/password', [SettingsController::class, 'showChangePasswordForm'])
        ->name('password.change');
    Route::post('/settings/password', [SettingsController::class, 'changePassword']);

    // Change Email
    Route::get('/settings/email', [SettingsController::class, 'showChangeEmailForm'])
        ->name('email.change');
    Route::post('/settings/email', [SettingsController::class, 'changeEmail']);

    // Delete Account
    Route::get('/settings/delete', [SettingsController::class, 'showDeleteAccountForm'])
        ->name('account.delete');
    Route::delete('/settings/delete', [SettingsController::class, 'deleteAccount']);

    // Update Settings
    Route::post('/settings/update', [SettingsController::class, 'updateSettings'])
        ->name('settings.update');
});
