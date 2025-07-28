<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    session_start();
    $_SESSION['user_id'] = null;
    $_SESSION['sso_user_id'] = null;
    return view('auth.login');
});
Route::get('/admin/login', function () {
    session_start();
    $_SESSION['user_id'] = null;
    $_SESSION['sso_user_id'] = null;
    return view('auth.login_admin');
});

Route::post('/auth/login/create', [AuthController::class, 'create'])->name('login.create');
Route::get('/auth/register', [AuthController::class, 'index']);
Route::get('/auth/logout', [AuthController::class, 'destroy'])->name('logout');
Route::post('/auth/register/store', [AuthController::class, 'store'])->name('register.store');
Route::get('/dashboard/riwayat', [DashboardController::class, 'index']);
Route::get('/dashboard/show/{id}', [DashboardController::class, 'show'])->name('store.show');
Route::get('/dashboard/change/{id}', [DashboardController::class, 'editpage']);
Route::get('/dashboard/form', [DashboardController::class, 'create']);
Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('store.pengajuan');
Route::post('/dashboard/change-data/{id}', [DashboardController::class, 'storeUpdate'])->name('update.pengajuan');
Route::post('/dashboard/edit/{id}', [DashboardController::class, 'edit'])->name('store.sending');
Route::delete('/dashboard/destroy/{id}', [DashboardController::class, 'destroy'])->name('store.destroy');

Route::post('/auth/admin/login', [AuthController::class, 'admin'])->name('login.admin');
Route::get('/dashboard/verify', [DashboardController::class, 'verify']);
Route::post('/dashboard/verify/response/{id}', [DashboardController::class, 'update'])->name('verify.saved');
Route::get('/dashboard/verify/show/{id}', [DashboardController::class, 'verifyshow'])->name('verify.show');
