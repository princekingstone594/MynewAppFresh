<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_user'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/admin', [AuthController::class, 'admin']);
    Route::get('/admin/users', [AuthController::class, 'users']);

    Route::post('/admin/users/{id}/role', [AuthController::class, 'updateRole']);
    Route::post('/admin/users/{id}/delete', [AuthController::class, 'deleteUser']);

});