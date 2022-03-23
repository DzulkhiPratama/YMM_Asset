<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetDashController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UseradminController;
use App\Http\Controllers\UserorderController;

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

// route yg untuk GUEST (belum log in)
Route::get('/', [AssetController::class, 'index']);
Route::get('/detail/{assetid}', [AssetController::class, 'show']);
Route::get('/resume', [AssetController::class, 'resume']);

// hanya bisa diakses oleh user yang sudah log in (auth)
// dengan menggunakan resource , bisa menghandle CRUD , dengan definis seperti ini sja
Route::resource('/dashboard', AssetDashController::class)->middleware('auth');
Route::resource('/transaction', TransactionController::class)->middleware('auth');
Route::resource('/order', UserorderController::class)->middleware('auth');
Route::resource('/admin', UseradminController::class)->middleware('auth');

// ---

// dijalankan ketika kita belum log in, as a guest. 
// terus route dikasih nama agar ketika nanti meng akses halaman yg harus auth dulu, bisa redirect ke route yg namanya login (video sandika laravel8-16)
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// ---

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// hanya bisa diakses oleh user yang belum log in (as guest)
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// ---
Route::post('/register', [RegisterController::class, 'store']);
