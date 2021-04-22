<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\imgBase\BaseController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\DashboardController;


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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('reject-user', [AdminController::class, 'rejectUser']);
Route::post('approve-user', [AdminController::class, 'approveUser']);
Route::post('change-permission', [AdminController::class, 'changePermission']);
Route::get('/pendings', [AdminController::class, 'pendedUsers'])->name("pending");
Route::get('/users', [AdminController::class, 'getUsers'])->name("users");

Route::get('/bases/new', [BaseController::class, 'index'])->name("newBase");
Route::post('add-app-type', [BaseController::class, 'storeApplicationType']);
Route::post('/bases/new', [BaseController::class, 'storeBase']);
Route::get('/bases/download', [BaseController::class, 'showFile']);




Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('dashboard',[DashboardController::class,'show']);
