<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;


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
Route::get('/register', [RegisterController::class, 'index'])->name('register');
//Route::post('/login/checklogin', 'LoginController@checklogin');
//Route::get('/login/successlogin', 'LoginController@checklogin');
Route::get('/login/successlogin', [LoginController::class, 'successlogin'])->name('success');  
Route::post('/login/checklogin',  [LoginController::class, 'checklogin'])->name('check'); 
//Route::get('/login/logout',  [LoginController::class, 'logout'])->name('login'); 

Route::get('/', function () {
    return view('app');
});
