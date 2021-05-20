<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\imgBase\BaseController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\LiveSearch;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;

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
Route::get('edit', [RegisterController::class, 'edit'])->name('edit');
Route::post('edit', [RegisterController::class, 'update']);
Route::get('profile', [ProfileController::class, 'profile'])->name('profile');

Route::post('reject-user', [AdminController::class, 'rejectUser']);
Route::post('approve-user', [AdminController::class, 'approveUser']);
Route::post('change-permission', [AdminController::class, 'changePermission']);
Route::get('/pendings', [AdminController::class, 'pendedUsers'])->name("pending");
Route::get('/users', [AdminController::class, 'getUsers'])->name("users");


Route::get('/bases/new', [BaseController::class, 'index'])->name("newBase");
Route::post('add-app-type', [BaseController::class, 'storeApplicationType']);
Route::post('/bases/new', [BaseController::class, 'storeBase']);
Route::post('/bases/upload', [BaseController::class, 'uploadBase']);

Route::get('/bases/download', [BaseController::class, 'showFile']);

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/autocomplete', [AutocompleteController::class, 'index']);
Route::post('/autocomplete/fetch', [AutocompleteController::class, 'fetch'])->name('autocomplete.fetch');

Route::get('/list', [SearchController::class, 'index']);
Route::post('/list/action', [SearchController::class, 'action'])->name('list.action');
/*Route::get('/live_search', 'LiveSearch@index');
Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');*/
//Route::get('/','SearchController@index');

Route::get('/bases/new', [BaseController::class, 'index'])->name("newBase")->middleware('auth');
Route::get('/bases/{id}', [BaseController::class, 'baseIndex'])->name('baseIndex');
Route::get('/bases/user/{user_id}', [BaseController::class, 'userBases']);


Route::post('add-app-type', [BaseController::class, 'storeApplicationType'])->middleware('auth');
Route::post('/bases/new', [BaseController::class, 'storeBase'])->middleware('auth');
Route::post('/bases/upload', [BaseController::class, 'uploadBase'])->middleware('auth');
Route::post('delete-base', [BaseController::class, 'deleteBase'])->middleware('auth');

Route::get('download-base', [BaseController::class, 'downloadBase']);
Route::get('find-file', [BaseController::class, 'findBase']);





Route::get('/bases/{path}', [BaseController::class, 'showFile']);




