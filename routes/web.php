<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LulusanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KataController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TranskripController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AjarController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SkripsiController;
use App\Http\Controllers\UjiController;
use App\Http\Controllers\KegiatanController;
use App\http\Controllers\BatchController;

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
//     return view('index');
// });

// Front Page
Route::get('/', [IndexController::class, 'index'])->name('home.index');
Route::get('/skripsi', [IndexController::class, 'skripsi'])->name('home.skripsi.index');
Route::post('/skripsi', [SkripsiController::class, 'store'])->name('home.skripsi.store');

Route::get('/webmin/prank', function () {
    return view('hello');
});

//Login
Route::group(['middleware' => 'guestadm'], function () {
    Route::get('/webmin', [AdminController::class, 'index'])->name('webmin');
    Route::post('/webmin', [AdminController::class, 'auth'])->name('webmin.auth');
});
Route::get('/webmin/logout', [AdminController::class, 'logout'])->name('webmin.logout');

//Admin Routes
Route::group(['middleware' => 'adminauth'], function () {
    //Dashboard Routes
    Route::get('/webmin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //Jurusan Routes
    Route::resources(['webmin/jurusan' => JurusanController::class,]);
    //Lulusan Routes
    Route::get('webmin/lulusan', [LulusanController::class, 'index'])->name('lulusan.index');
    Route::get('webmin/lulusan/create', [LulusanController::class, 'create'])->name('lulusan.create');
    Route::post('webmin/lulusan', [LulusanController::class, 'store'])->name('lulusan.store');
    Route::get('webmin/lulusan/{lulusan}/edit', [LulusanController::class, 'edit'])->name('lulusan.edit');
    Route::put('webmin/lulusan/{lulusan}', [LulusanController::class, 'update'])->name('lulusan.update');
    Route::delete('webmin/lulusan/{lulusan}', [LulusanController::class, 'destroy'])->name('lulusan.destroy');
    Route::get('webmin/lulusan/template', [LulusanController::class, 'DownloadTemplate'])->name('lulusan.template');
    Route::get('webmin/lulusan/import', [LulusanController::class, 'import'])->name('lulusan.import');
    Route::post('webmin/lulusan/impview', [LulusanController::class, 'importView'])->name('lulusan.impview');
    Route::post('webmin/lulusan/import', [LulusanController::class, 'importData'])->name('lulusan.impData');
    //Jabatan Routes
    Route::resources(['webmin/jabatan' => JabatanController::class,]);
    //List Kata Routes
    Route::resources(['webmin/kata' => KataController::class,]);
    //Nilai Routes
    Route::get('webmin/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('webmin/nilai/import', [NilaiController::class, 'import'])->name('nilai.import');
    Route::post('webmin/nilai/import', [NilaiController::class, 'impStore'])->name('nilai.impStore');
    Route::get('webmin/nilai/create', [NilaiController::class, 'create'])->name('nilai.create');
    Route::post('webmin/nilai', [NilaiController::class, 'store'])->name('nilai.store');
    Route::get('webmin/nilai/{nilai}/edit', [NilaiController::class, 'edit'])->name('nilai.edit');
    Route::put('webmin/nilai/{nilai}', [NilaiController::class, 'update'])->name('nilai.update');
    Route::delete('webmin/nilai/{nilai}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
    Route::get('webmin/nilai/pindah', [NilaiController::class, 'pindah'])->name('nilai.import.pindah');
    Route::post('webmin/nilai/pindah', [NilaiController::class, 'pindahStore'])->name('nilai.impstore.pindah');
    //Dosen Routes
    Route::get('webmin/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('webmin/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('webmin/dosen', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('webmin/dosen/{dosen}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('webmin/dosen/{dosen}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('webmin/dosen/{dosen}', [DosenController::class, 'destroy'])->name('dosen.destroy');
    Route::get('webmin/dosen/template', [DosenController::class, 'DownloadTemplate'])->name('dosen.template');
    Route::get('webmin/dosen/import', [DosenController::class, 'import'])->name('dosen.import');
    Route::post('webmin/dosen/impview', [DosenController::class, 'importView'])->name('dosen.impview');
    Route::post('webmin/dosen/import', [DosenController::class, 'importData'])->name('dosen.impData');
    //Mahasiswa Routes
    Route::get('webmin/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('webmin/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('webmin/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('webmin/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('webmin/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('webmin/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    Route::get('webmin/mahasiswa/template', [MahasiswaController::class, 'DownloadTemplate'])->name('mahasiswa.template');
    Route::get('webmin/mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
    Route::post('webmin/mahasiswa/impview', [MahasiswaController::class, 'importView'])->name('mahasiswa.impview');
    Route::post('webmin/mahasiswa/import', [MahasiswaController::class, 'importData'])->name('mahasiswa.impData');
    //Transkrip Route
    Route::get('webmin/transkrip', [TranskripController::class, 'index'])->name('transkrip.index');
    Route::get('webmin/transkrip/print', [TranskripController::class, 'print'])->name('transkrip.print');
    Route::get('webmin/transkrip/edit', [TranskripController::class, 'edit'])->name('transkrip.edit');
    //Settings Route
    Route::get('webmin/parameter', [SettingController::class, 'parameter'])->name('setting.parameter');
    Route::post('webmin/parameter', [SettingController::class, 'parameterStore'])->name('setting.parameter.store');
    Route::get('webmin/password', [SettingController::class, 'password'])->name('setting.password');
    Route::post('webmin/password', [SettingController::class, 'passwordStore'])->name('setting.password.store');
    Route::get('webmin/profil', [SettingController::class, 'profil'])->name('setting.profil');
    Route::post('webmin/profil', [SettingController::class, 'profilStore'])->name('setting.profil.store');
    //Ajar Route
    Route::get('webmin/ajar', [AjarController::class, 'index'])->name('ajar.index');
    Route::get('webmin/ajar/create', [AjarController::class, 'create'])->name('ajar.create');
    Route::post('webmin/ajar', [AjarController::class, 'store'])->name('ajar.store');
    Route::get('webmin/ajar/{ajar}/edit', [AjarController::class, 'edit'])->name('ajar.edit');
    Route::put('webmin/ajar/{ajar}', [AjarController::class, 'update'])->name('ajar.update');
    Route::delete('webmin/ajar/{ajar}', [AjarController::class, 'destroy'])->name('ajar.destroy');
    //Kegiatan Route
    Route::resources(['webmin/kegiatan' => KegiatanController::class]);
    //Batch Route
    Route::resources(['webmin/batch' => BatchController::class]);
    //Daftar Skripsi Route
    Route::resources(['webmin/skripsi' => SkripsiController::class]);
});

Route::get('uji', [UjiController::class, 'index'])->name('uji.index');
