use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


// PUBLIC
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);


// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


// USER ROUTES
Route::middleware(['auth', 'is_user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});


// ADMIN ROUTES
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/users', [AdminController::class, 'users']);

    Route::post('/admin/users/{id}/role', [AdminController::class, 'updateRole']);
    Route::post('/admin/users/{id}/delete', [AdminController::class, 'deleteUser']);
});