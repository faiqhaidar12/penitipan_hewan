<?php

use App\Http\Controllers\HalamanController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenitipanController;
use App\Http\Controllers\SessionController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HalamanController::class, 'index']);
Route::get('/kontak', [HalamanController::class, 'kontak']);
Route::get('/tentang', [HalamanController::class, 'tentang']);

Route::resource('pelanggan', PelangganController::class)->middleware('isLogin');
Route::resource('hewan', HewanController::class)->middleware('isLogin');
Route::resource('penitipan', PenitipanController::class)->middleware('isLogin');

Route::get('/sesi', [SessionController::class, 'index'])->middleware('isGuest');
Route::post('/sesi/login', [SessionController::class, 'login'])->middleware('isGuest');
Route::get('/sesi/register', [SessionController::class, 'register'])->middleware('isGuest');
Route::post('/sesi/create', [SessionController::class, 'create'])->middleware('isGuest');
Route::get('/sesi/logout', [SessionController::class, 'logout']);
