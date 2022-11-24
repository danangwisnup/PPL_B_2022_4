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
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProgressMhsContoller;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\EntryProgressController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\EditProfileDosenController;
use App\Http\Controllers\VerifikasiBerkasController;
use App\Http\Controllers\EditProfileOperatorController;
use App\Http\Controllers\EditProfileDepartmentController;

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

Route::group(['middleware' => ['prevent-back-history']], function () {
    // Home 
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Auth (login & logout)
    Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
    Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest')->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
});

// Middleware auth
Route::group(['middleware' => ['auth', 'prevent-back-history']], function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('editprofile')->name('dashboard');

    // Fiture Operator
    Route::group(['middleware' => ['operator']], function () {
        // add user & manajamen user (CRUD User)
        Route::get('/operator/add_user', [AddUserController::class, 'index'])->name('add_user');
        Route::get('/operator/manage_users', [ManageUsersController::class, 'index'])->name('manage_users');
        Route::resource('/operator/mahasiswa', MahasiswaController::class);
        Route::post('/operator/mahasiswa/bulk', [MahasiswaController::class, 'bulk'])->name('mahasiswa.bulk');
        Route::resource('/operator/dosen', DosenController::class);
        Route::post('/operator/dosen/bulk', [DosenController::class, 'bulk'])->name('dosen.bulk');
        // delete user
        Route::get('/operator/delete_mahasiswa/{id}', [MahasiswaController::class, 'delete'])->name('delete_mahasiswa');
        Route::get('/operator/delete_dosen/{id}', [DosenController::class, 'delete'])->name('delete_dosen');
    });

    // Fiture Department
    Route::group(['middleware' => ['department']], function () {
        // progress studi mahasiswa
        Route::get('/department/progress_studi_mahasiswa', [ProgressMhsContoller::class, 'department']);
        Route::get('/department/progress_studi_mahasiswa/detail', [ProgressMhsContoller::class, 'show'])->name('department_progress_detail');
        Route::get('/department/progress_studi_mahasiswa/semester', [ProgressMhsContoller::class, 'show_semester'])->name('department_progress_detail_semester');

        // berkas mahasiswa
        Route::get('/department/berkas_mahasiswa/detail', [VerifikasiBerkasController::class, 'show'])->name('department_berkas_detail');

        // data dosen
        Route::get('/department/data_dosen', [DosenController::class, 'data_dosen']);
        Route::post('/department/data_dosen/detail', [DosenController::class, 'data_dosen_detail'])->name('data_dosen_detail');

        // data mahasiswa
        Route::get('/department/data_mahasiswa', [MahasiswaController::class, 'data_mahasiswa']);
        Route::post('/department/data_mahasiswa/detail', [MahasiswaController::class, 'data_mahasiswa_detail'])->name('data_mahasiswa_detail');

        // data mahasiswa pkl
        Route::get('/department/data_mahasiswa_pkl', [MahasiswaController::class, 'data_pkl']);

        // data mahasiswa skripsi
        Route::get('/department/data_mahasiswa_skripsi', [MahasiswaController::class, 'data_skripsi']);
    });

    // Fiture Dosen
    Route::group(['middleware' => ['dosen', 'editprofile']], function () {
        // progress studi mahasiswa
        Route::get('/dosen/progress_studi_mahasiswa', [ProgressMhsContoller::class, 'dosen']);
        Route::get('/dosen/progress_studi_mahasiswa/detail', [ProgressMhsContoller::class, 'show'])->name('progress_detail');
        Route::get('/dosen/progress_studi_mahasiswa/semester', [ProgressMhsContoller::class, 'show_semester'])->name('progress_detail_semester');

        // verifikasi berkas mahasiswa
        Route::get('/dosen/verifikasi_berkas_mahasiswa', [VerifikasiBerkasController::class, 'index']);
        Route::get('/dosen/verifikasi_berkas_mahasiswa/detail', [VerifikasiBerkasController::class, 'show'])->name('berkas_detail');
        Route::post('/dosen/verifikasi_berkas_mahasiswa/update', [VerifikasiBerkasController::class, 'update'])->name('verifikasi_update');
    });

    // Fiture Mahasiswa
    Route::group(['middleware' => ['mahasiswa', 'editprofile']], function () {
        // entry progress
        Route::get('/mahasiswa/entry', [EntryProgressController::class, 'index'])->middleware('entry_progress');
        Route::post('/mahasiswa/entry', [EntryProgressController::class, 'entry_progress'])->name('entry_progress');

        // irs
        Route::resource('/mahasiswa/irs', IRSController::class);
        Route::get('/mahasiswa/data/irs', [IRSController::class, 'data'])->name('data_irs');
        Route::get('/mahasiswa/irs/{semester}/{nim}/edit', [IRSController::class, 'edit'])->name('irs.edit');

        // khs
        Route::resource('/mahasiswa/khs', KHSController::class);
        Route::get('/mahasiswa/data/khs', [KHSController::class, 'data'])->name('data_khs');
        Route::get('/mahasiswa/khs/{semester}/{nim}/edit', [KHSController::class, 'edit'])->name('khs.edit');

        // pkl
        Route::resource('/mahasiswa/pkl', PKLController::class);
        Route::get('/mahasiswa/data/pkl', [PKLController::class, 'data'])->name('data_pkl');
        Route::get('/mahasiswa/pkl/{semester}/{nim}/edit', [PKLController::class, 'edit'])->name('pkl.edit');

        // skripsi
        Route::resource('/mahasiswa/skripsi', SkripsiController::class);
        Route::get('/mahasiswa/data/skripsi', [SkripsiController::class, 'data'])->name('data_skripsi');
        Route::get('/mahasiswa/skripsi/{semester}/{nim}/edit', [SkripsiController::class, 'edit'])->name('skripsi.edit');
    });

    //edit profile
    Route::resource('/dosen/edit_profile', EditProfileDosenController::class)->middleware('dosen')->names('edit_profile_dosen');
    Route::resource('/mahasiswa/edit_profile', EditProfileController::class)->middleware('mahasiswa')->names('edit_profile_mahasiswa');
    Route::resource('/operator/edit_profile', EditProfileOperatorController::class)->middleware('operator')->names('edit_profile_operator');
    Route::resource('/department/edit_profile', EditProfileDepartmentController::class)->middleware('department')->names('edit_profile_department');

    // Change Password
    Route::resource('/dosen/change_password', PasswordController::class);
    Route::resource('/mahasiswa/change_password', PasswordController::class);
    Route::resource('/operator/change_password', PasswordController::class);
    Route::resource('/department/change_password', PasswordController::class);

    // Wilayah Indonesia
    Route::get('/wilayah/{provinsi}', [WilayahController::class, 'index'])->name('wilayah');

    // Upload File
    Route::post('/upload', [UploadController::class, 'upload']);
});

// Login & Logout [Done]
// Dashboard [Done]
// Fiture Operator: Add User [Done]
// Fiture Operator: Manajemen User [Done]
// Fiture Operator: CRUD Mahasiswa [Done]
// Fiture Operator: CRUD Dosen [Done]
// Fiture Department: Progress Studi Mahasiswa [Done]
// Fiture Department: Data Mahasiswa [Done]
// Fiture Department: Data Dosen [Done]
// Fiture Dosen: Progress Studi Mahasiswa [Done]
// Fiture Dosen: Verifikasi Berkas Mahasiswa [Done]
// Fiture Dosen: Data Mahasiswa [Done]
// Fiture Dosen: Data Mahasiswa PKL [Done]
// Fiture Dosen: Data Mahsiswa Skripsi [Done]
// Fiture Mahasiswa: edit profile [Done]
// Fiture Mahasiswa: IRS [Done]
// Fiture Mahasiswa: KHS [Done]
// Fiture Mahasiswa: PKL [Done]
// Fiture Mahasiswa: Skripsi [Done]
