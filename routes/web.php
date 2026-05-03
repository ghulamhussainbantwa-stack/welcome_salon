<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;

/* =========================================
   PUBLIC / USER SITE ROUTES
   ========================================= */
Route::get('/',          [LandingController::class, 'index'])->name('welcome');
Route::get('/services',  [LandingController::class, 'services'])->name('services');
Route::get('/about',     [LandingController::class, 'about'])->name('about');
Route::get('/book',      [LandingController::class, 'book'])->name('book');
Route::get('/contact',   [LandingController::class, 'contact'])->name('contact');
Route::post('/contact',  [LandingController::class, 'storeMessage'])->name('contact.store');
Route::post('/book-now', [LandingController::class, 'store'])->name('public.book');
Route::post('/subscribe', [LandingController::class, 'subscribe'])->name('newsletter.subscribe');

/* =========================================
   AUTH ROUTES
   ========================================= */
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

/* =========================================
   ADMIN ROUTES (Protected)
   ========================================= */
// ADMIN ROUTES (Strict Auth)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Management Resources
    Route::resource('users', UserController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('messages', MessageController::class)->only(['index', 'show', 'destroy']);

    // AJAX API (Admin Only)
    Route::prefix('api')->group(function () {
        Route::post('/customers', [CustomerController::class, 'store']);
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
        Route::post('/services', [ServiceController::class, 'store']);
        Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
        Route::post('/appointments/status', [AppointmentController::class, 'updateStatus']);
    });
});
