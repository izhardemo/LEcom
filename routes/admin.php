<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

// Profile Routes
Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'role:super_admin|admin', config('jetstream.auth_session')])->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminProfileController::class, 'index'])->name('view');
        Route::post('/update/{user}', [App\Http\Controllers\Admin\AdminProfileController::class, 'update'])->name('update');
        Route::post('/change-password/{user}', [App\Http\Controllers\Admin\AdminProfileController::class, 'store'])->name('password');
        Route::post('/remove-photo/{user}/{type}', [App\Http\Controllers\Admin\AdminProfileController::class, 'destroy'])->name('removePhoto');
        Route::post('/logout-other-browser-session/{user}/{type}', [App\Http\Controllers\Admin\AdminProfileController::class, 'destroy'])->name('logout.other.browser');
    });
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:super_admin|admin', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Category routes
    Route::resource('category', CategoryController::class)->middleware('role:super_admin');

    // product routes
    Route::resource('product', ProductController::class)->middleware('role:super_admin');
    
});

Route::get('/admin', function() {
    return redirect()->route('admin.dashboard');
});
