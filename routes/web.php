<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IRSController;
use App\Http\Controllers\KHSController;
use App\Http\Controllers\PKLController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\ManajemenUserController;

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

// Fiture Operator: Add User & Manajemen User
Route::get('/operator/add_user', [AddUserController::class, 'index'])->middleware('auth', 'operator')->name('user_add');
Route::get('/operator/manajemen_user', [ManajemenUserController::class, 'index'])->middleware('auth', 'operator')->name('user_manajemen');
Route::resource('/operator/mahasiswa', MahasiswaController::class)->middleware('auth', 'operator');
Route::resource('/operator/dosen', DosenController::class)->middleware('auth', 'operator');

// Fiture Mahasiswa: edit profile
Route::resource('/mahasiswa/edit_profile', EditProfileController::class)->middleware('auth', 'mahasiswa');

// Fiture Mahasiswa: irs
Route::resource('/mahasiswa/irs', IRSController::class)->middleware('auth', 'mahasiswa');
Route::get('/mahasiswa/irs/{semester}/{nim}/edit', [IRSController::class, 'edit'])->middleware('auth', 'mahasiswa')->name('irs.edit');

// Fiture Mahasiswa: khs
Route::resource('/mahasiswa/khs', KHSController::class)->middleware('auth', 'mahasiswa');
Route::get('/mahasiswa/khs/{semester}/{nim}/edit', [KHSController::class, 'edit'])->middleware('auth', 'mahasiswa')->name('khs.edit');

// Fiture Mahasiswa: pkl
Route::resource('/mahasiswa/pkl', PKLController::class)->middleware('auth', 'mahasiswa');
Route::get('/mahasiswa/pkl/{semester}/{nim}/edit', [PKLController::class, 'edit'])->middleware('auth', 'mahasiswa')->name('pkl.edit');

// Mahasiswa: skripsi
Route::resource('/mahasiswa/skripsi', SkripsiController::class)->middleware('auth', 'mahasiswa');
Route::get('/mahasiswa/skripsi/{semester}/{nim}/edit', [SkripsiController::class, 'edit'])->middleware('auth', 'mahasiswa')->name('skripsi.edit');

// Fiture Department: progress studi mahasiswa
Route::get('/department/progress_studi_mahasiswa', function () {
    return view('department.progress.index', [
        'title' => 'Progress Studi Mahasiswa',
    ]);
});

// Fiture Department: data mahasiswa
Route::get('/department/data_mahasiswa', function () {
    return view('department.data_mahasiswa', [
        'title' => 'Data Mahasiswa',
    ]);
});

// Fiture Department: data dosen
Route::get('/department/data_dosen', function () {
    return view('department.data_dosen', [
        'title' => 'Data Dosen',
    ]);
});

// Fiture Dosen: progress studi mahasiswa
Route::get('/dosen/progress_studi_mahasiswa', function () {
    return view('dosen.progress.index', [
        'title' => 'Progress Studi Mahasiswa',
    ]);
});

// Fiture Dosen: verifikasi berkas mahasiswa
Route::get('/dosen/verifikasi_berkas_mahasiswa', function () {
    return view('dosen.verifikasi.index', [
        'title' => 'Verifikasi Berkas Mahasiswa',
    ]);
});

// Wilayah Indonesia
Route::get('/wilayah/{provinsi}', [WilayahController::class, 'index'])->middleware('auth')->name('wilayah');

// Upload File
Route::post('/upload', [UploadController::class, 'upload'])->middleware('auth');

// Login & Logout [Done]
// Dashboard [Done]

// Fiture Operator: Add User [Done]
// Fiture Operator: Manajemen User [Done]
// Fiture Operator: CRUD Mahasiswa [Done]
// Fiture Operator: CRUD Dosen [Done]

// Fiture Mahasiswa: edit profile 
// Fiture Mahasiswa: IRS [Done]
// Fiture Mahasiswa: KHS
// Fiture Mahasiswa: PKL
// Fiture Mahasiswa: Skripsi

// Fiture Dosen: Progress Studi Mahasiswa
// Fiture Dosen: Verifikasi Berkas Mahasiswa
// Fiture Dosen: Data Mahasiswa
// Fiture Dosen: Data Mahasiswa PKL
// Fiture Dosen: Data Mahsiswa Skripsi

// Fiture Department: Progress Studi Mahasiswa
// Fiture Department: Data Mahasiswa
// Fiture Department: Data Dosen
