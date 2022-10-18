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
use App\Http\Controllers\ProgressMhsContoller;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\EntryProgressController;
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
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->middleware('editprofile')->name('dashboard');

// Fiture Operator: 
Route::group(['middleware' => ['auth', 'operator']], function () {
    Route::get('/operator/add_user', [AddUserController::class, 'index'])->name('user_add');
    Route::get('/operator/manajemen_user', [ManajemenUserController::class, 'index'])->name('user_manajemen');
    Route::resource('/operator/mahasiswa', MahasiswaController::class);
    Route::resource('/operator/dosen', DosenController::class);
});

// Fiture Mahasiswa: edit profile
Route::resource('/mahasiswa/edit_profile', EditProfileController::class)->middleware('auth')->middleware('mahasiswa');

// Fiture Mahasiswa: 
Route::group(['middleware' => ['auth', 'mahasiswa', 'editprofile']], function () {

    // Fiture Mahasiswa: entry progress
    Route::get('/mahasiswa/entry', [EntryProgressController::class, 'index'])->middleware('entry_progress');
    Route::post('/mahasiswa/entry', [EntryProgressController::class, 'entry_progress'])->name('entry_progress');

    // Fiture Mahasiswa: irs
    Route::resource('/mahasiswa/irs', IRSController::class);
    Route::get('/mahasiswa/entry/irs', [IRSController::class, 'index'])->middleware('irs');
    Route::get('/mahasiswa/data/irs', [IRSController::class, 'data'])->name('data_irs');
    Route::get('/mahasiswa/irs/{semester}/{nim}/edit', [IRSController::class, 'edit'])->name('irs.edit');

    // Fiture Mahasiswa: khs
    Route::resource('/mahasiswa/khs', KHSController::class);
    Route::get('/mahasiswa/entry/khs', [KHSController::class, 'index'])->middleware('khs');
    Route::get('/mahasiswa/data/khs', [KHSController::class, 'data'])->name('data_khs');
    Route::get('/mahasiswa/khs/{semester}/{nim}/edit', [KHSController::class, 'edit'])->name('khs.edit');

    // Fiture Mahasiswa: pkl
    Route::resource('/mahasiswa/pkl', PKLController::class);
    Route::get('/mahasiswa/entry/pkl', [PKLController::class, 'index'])->middleware('pkl');
    Route::get('/mahasiswa/data/pkl', [PKLController::class, 'data'])->name('data_pkl');
    Route::get('/mahasiswa/pkl/{semester}/{nim}/edit', [PKLController::class, 'edit'])->name('pkl.edit');

    // Mahasiswa: skripsi
    Route::resource('/mahasiswa/skripsi', SkripsiController::class);
    Route::get('/mahasiswa/entry/skripsi', [SkripsiController::class, 'index'])->middleware('skripsi');
    Route::get('/mahasiswa/data/skripsi', [SkripsiController::class, 'data'])->name('data_skripsi');
    Route::get('/mahasiswa/skripsi/{semester}/{nim}/edit', [SkripsiController::class, 'edit'])->name('skripsi.edit');
});

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
Route::resource('/dosen/progress_studi_mahasiswa', ProgressMhsContoller::class);

// Fiture Dosen: verifikasi berkas mahasiswa
Route::get('/dosen/verifikasi_berkas_mahasiswa', function () {
    return view('dosen.verifikasi.index', [
        'title' => 'Verifikasi Berkas Mahasiswa',
    ]);
});

// Dosen: data mahasiswa
route::get('/dosen/data_mahasiswa', function () {
    return view('dosen.data_mhs.index', [
        'title' => 'Data Mahasiswa',
    ]);
});

// Dosen: data mahasiswa pkl
route::get('/dosen/data_mahasiswa_pkl', function () {
    return view('dosen.data_pkl.index', [
        'title' => 'Data Mahasiswa PKL',
    ]);
});

// Dosen: data mahasiswa skripsi
route::get('/dosen/data_mahasiswa_skripsi', function () {
    return view('dosen.data_skripsi.index', [
        'title' => 'Data Mahasiswa Skripsi',
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

// Fiture Mahasiswa: edit profile [Done]
// Fiture Mahasiswa: IRS [Done]
// Fiture Mahasiswa: KHS [Done]
// Fiture Mahasiswa: PKL [Done]
// Fiture Mahasiswa: Skripsi [Done]

// Fiture Dosen: Progress Studi Mahasiswa 
// Fiture Dosen: Verifikasi Berkas Mahasiswa
// Fiture Dosen: Data Mahasiswa
// Fiture Dosen: Data Mahasiswa PKL
// Fiture Dosen: Data Mahsiswa Skripsi

// Fiture Department: Progress Studi Mahasiswa
// Fiture Department: Data Mahasiswa
// Fiture Department: Data Dosen
