<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\User\{DashboardController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication...
Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

// Registration...
Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Profile Routes
Route::prefix('user')->name('user.')->middleware(['auth:sanctum', 'role:user', config('jetstream.auth_session')
])->group(function() {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\User\UserProfileController::class, 'index'])->name('view');
        Route::post('/update/{user}', [App\Http\Controllers\User\UserProfileController::class, 'update'])->name('update');
        Route::post('/change-password/{user}', [App\Http\Controllers\User\UserProfileController::class, 'store'])->name('password');
        Route::post('/remove-photo/{user}/{type}', [App\Http\Controllers\User\UserProfileController::class, 'destroy'])->name('removePhoto');
        Route::post('/logout-other-browser-session/{user}/{type}', [App\Http\Controllers\User\UserProfileController::class, 'destroy'])->name('logout.other.browser');
    });
});

// User Routes
Route::name('user.')->middleware(['auth:sanctum', 'role:user', config('jetstream.auth_session'), 'verified'
])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Include Admin Routes
require __DIR__.'/admin.php';

Route::fallback(function() {
    return view('errors.404');
});