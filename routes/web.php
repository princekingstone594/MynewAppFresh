<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (FINAL STABLE SETUP)
|--------------------------------------------------------------------------
*/

// Guest routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});


// Auth routes
Route::middleware(['auth'])->group(function () {

    // ADMIN DASHBOARD
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

    // USER DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('role:user')->name('dashboard');

    // LOGOUT (POST ONLY)
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


// ✅ GLOBAL FALLBACK (OUTSIDE auth)
Route::get('/logout', function () {
    return redirect('/login');
})->name('logout.get');