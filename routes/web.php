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
    return view('auth.login');
});

Route::post('/auth/login/create', [AuthController::class, 'create'])->name('login.create');
Route::get('/auth/register', [AuthController::class, 'index']);
Route::post('/auth/register/store', [AuthController::class, 'store'])->name('register.store');
Route::get('/dashboard/riwayat', [DashboardController::class, 'index']);
