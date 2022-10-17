<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IRSController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\EditProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
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
Route::get('/operator/add_user', [DashboardController::class, 'add_user'])->middleware('auth', 'operator')->name('user_add');

// Operator: Manajemen User
Route::get('/operator/manajemen_user', [DashboardController::class, 'manajemen_user'])->middleware('auth', 'operator')->name('user_manajemen');

// Operator: CRUD Mahasiswa
Route::resource('/operator/mahasiswa', MahasiswaController::class)->middleware('auth', 'operator');

// Operator: CRUD Dosen
Route::resource('/operator/dosen', DosenController::class)->middleware('auth', 'operator');

// Mahasiswa: edit profile
Route::resource('/mahasiswa/edit_profile', EditProfileController::class)->middleware('auth', 'mahasiswa');

// Mahasiswa: irs
Route::get('/mahasiswa/irs', [DashboardController::class, 'irs'])->middleware('auth', 'mahasiswa')->name('irs');
Route::resource('/mahasiswa/proses/irs', IRSController::class)->middleware('auth', 'mahasiswa');
Route::get('/mahasiswa/proses/irs/{semester}/{nim}/edit', [IRSController::class, 'edit'])->middleware('auth', 'mahasiswa')->name('irs.edit');

// Mahasiswa: khs
// Route::get('/mahasiswa/khs', [DashboardController::class, 'khs'])->middleware('auth', 'mahasiswa')->name('khs');
// Route::resource('/mahasiswa/proses/khs', KHSController::class)->middleware('auth', 'mahasiswa');
// Route::get('/mahasiswa/proses/irs/{semester}/{nim}/edit', [KHSController::class, 'edit'])->middleware('auth', 'mahasiswa')->name('khs.edit');

// Mahasiswa: pkl
// Route::get('/mahasiswa/pkl', [DashboardController::class, 'pkl'])->middleware('auth', 'mahasiswa')->name('pkl');
// Route::resource('/mahasiswa/proses/pkl', PKLController::class)->middleware('auth', 'mahasiswa');
// Route::get('/mahasiswa/proses/irs/{semester}/{nim}/edit', [PKLController::class, 'edit'])->middleware('auth', 'mahasiswa')->name('pkl.edit');

// Mahasiswa: skripsi
// Route::get('/mahasiswa/skripsi', [DashboardController::class, 'skripsi'])->middleware('auth', 'mahasiswa')->name('skripsi');
// Route::resource('/mahasiswa/proses/skripsi', SkripsiController::class)->middleware('auth', 'mahasiswa');
// Route::get('/mahasiswa/proses/irs/{semester}/{nim}/edit', [SkripsiController::class, 'edit'])->middleware('auth', 'mahasiswa')->name('skripsi.edit');

// Department: progress studi mahasiswa
Route::get('/department/progress_studi_mahasiswa', function () {
    return view('department.progress.index', [
        'title' => 'Progress Studi Mahasiswa',
    ]);
});

// Department: data mahasiswa
Route::get('/department/data_mahasiswa', function () {
    return view('department.data_mahasiswa', [
        'title' => 'Data Mahasiswa',
    ]);
});

// Department: data dosen
Route::get('/department/data_dosen', function () {
    return view('department.data_dosen', [
        'title' => 'Data Dosen',
    ]);
});

// Dosen: progress studi mahasiswa
Route::get('/dosen/progress_studi_mahasiswa', function () {
    return view('dosen.progress.index', [
        'title' => 'Progress Studi Mahasiswa',
    ]);
});

// Dosen: verifikasi berkas mahasiswa
Route::get('/dosen/verifikasi_berkas_mahasiswa', function () {
    return view('dosen.verifikasi.index', [
        'title' => 'Verifikasi Berkas Mahasiswa',
    ]);
});

// Wilayah Indonesia
Route::get('/wilayah/{provinsi}', [WilayahController::class, 'index'])->middleware('auth')->name('wilayah');

// Upload File
Route::post('/upload', [UploadController::class, 'upload'])->middleware('auth');


Route::get('/mahasiswa/khs', function () {
    return view('mahasiswa.khs.index', [
        'title' => 'KHS']);
});

Route::get('/mahasiswa/pkl', function () {
    return view('mahasiswa.pkl.index', [
        'title' => 'PKL']);
});

Route::get('/mahasiswa/skripsi', function () {
    return view('mahasiswa.skripsi.index', [
        'title' => 'Skripsi']);
});