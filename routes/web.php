<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

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

// Home 
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth (login & logout)
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Operator: Add User
Route::get('/operator/add_user', [UserController::class, 'add_user'])->middleware('auth', 'operator')->name('user_add');

// Operator: Manajemen User
Route::get('/operator/manajemen_user', [UserController::class, 'manajemen_user'])->middleware('auth', 'operator')->name('user_manajemen');

// Operator: CRUD Mahasiswa
Route::post('/operator/add_mahasiswa', [UserController::class, 'add_mahasiswa'])->middleware('auth', 'operator')->name('add_mahasiswa');
Route::post('/operator/update_mahasiswa', [UserController::class, 'update_mahasiswa'])->middleware('auth', 'operator')->name('update_mahasiswa');
Route::post('/operator/delete_mahasiswa', [UserController::class, 'delete_mahasiswa'])->middleware('auth', 'operator')->name('delete_mahasiswa');

// Operator: CRUD Dosen
Route::post('/operator/add_dosen', [UserController::class, 'add_dosen'])->middleware('auth', 'operator')->name('add_dosen');
Route::post('/operator/update_dosen', [UserController::class, 'update_dosen'])->middleware('auth', 'operator')->name('update_dosen');
Route::post('/operator/delete_dosen', [UserController::class, 'delete_dosen'])->middleware('auth', 'operator')->name('delete_dosen');

// Route::get('/dashboard', function () {
//     return view('dashboad.index', [
//         'title' => 'Dosen',
//     ]);
// });

//