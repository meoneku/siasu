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
use App\Http\Controllers\BatchController;
use App\Http\Controllers\PiController;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\SemhasController;
use App\Http\Controllers\SuratAmbilDataController;
use App\Http\Controllers\SuratObservasiController;
use App\Http\Controllers\SuratPIController;

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

// Front Page
Route::get('/', [IndexController::class, 'index'])->name('home.index');
Route::get('/skripsi', [IndexController::class, 'skripsi'])->name('home.skripsi.index');
Route::post('/skripsi', [SkripsiController::class, 'store'])->name('home.skripsi.store');
Route::get('/seminar', [IndexController::class, 'seminar'])->name('home.seminar.index');
Route::post('/seminar', [SeminarController::class, 'store'])->name('home.seminar.store');
Route::get('/semhas', [IndexController::class, 'semhas'])->name('home.semhas.index');
Route::post('/semhas', [SemhasController::class, 'store'])->name('home.semhas.store');
Route::get('/kppi', [IndexController::class, 'kppi'])->name('home.kppi.index');
Route::post('/kppi', [PiController::class, 'store'])->name('home.kppi.store');
Route::get('/suratpi', [IndexController::class, 'suratpi'])->name('home.suratpi.index');
Route::post('/suratpi', [SuratPIController::class, 'store'])->name('home.suratpi.store');
Route::get('/suratobservasi', [IndexController::class, 'suratobservasi'])->name('home.suratobservasi.index');
Route::post('/suratobservasi', [SuratObservasiController::class, 'store'])->name('home.suratobservasi.store');
Route::get('/ambildata', [IndexController::class, 'ambildata'])->name('home.ambildata.index');
Route::post('/ambildata', [SuratAmbilDataController::class, 'store'])->name('home.suratobservasi.store');

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
Route::group(['middleware' => 'is_login'], function () {

    //Dashboard Routes
    Route::get('/webmin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //For Superuser Routes
    Route::group(['middleware' => 'root'], function () {
        //Jurusan Routes
        Route::resources(['webmin/jurusan' => JurusanController::class,]);

        //Jabatan Routes
        Route::resources(['webmin/jabatan' => JabatanController::class,]);

        //Lulusan Route Delete
        Route::delete('webmin/lulusan/{lulusan}', [LulusanController::class, 'destroy'])->name('lulusan.destroy');

        //Settings Route
        Route::get('webmin/parameter', [SettingController::class, 'parameter'])->name('setting.parameter');
        Route::post('webmin/parameter', [SettingController::class, 'parameterStore'])->name('setting.parameter.store');

        //Kegiatan Route
        Route::resources(['webmin/kegiatan' => KegiatanController::class]);

        //Skripsi Route Delete
        Route::delete('webmin/skripsi/{skripsi}', [SkripsiController::class, 'destroy'])->name('skripsi.destroy');

        //Seminar Route Delete
        Route::delete('webmin/seminar/{seminar}', [SeminarController::class, 'destroy'])->name('seminar.destroy');

        //Seminar Hasil Route Delete
        Route::delete('webmin/semhas/{semhas}', [SeminarController::class, 'destroy'])->name('semhas.destroy');

        //KPPI Route Delete
        Route::delete('webmin/kppi/{kppi}', [PiController::class, 'destroy'])->name('kppi.destroy');

        //Surat PI Route Delete
        Route::delete('webmin/suratpi/{suratpi}', [SuratPIController::class, 'destroy'])->name('suratpi.destroy');

        //Surat Observasi Route Delete
        Route::delete('webmin/suratobservasi/{suratobservasi}', [SuratObservasiController::class, 'destroy'])->name('suratobservasi.destroy');
        
        //Surat Observasi Route Delete
        Route::delete('webmin/suratambildata/{suratambildata}', [SuratAmbilDataController::class, 'destroy'])->name('suratobservasi.destroy');
    });

    //Profil And Password Changes Routes
    Route::get('webmin/password', [SettingController::class, 'password'])->name('setting.password');
    Route::post('webmin/password', [SettingController::class, 'passwordStore'])->name('setting.password.store');
    Route::get('webmin/profil', [SettingController::class, 'profil'])->name('setting.profil');
    Route::post('webmin/profil', [SettingController::class, 'profilStore'])->name('setting.profil.store');

    //Lulusan Routes
    Route::get('webmin/lulusan', [LulusanController::class, 'index'])->name('lulusan.index');
    Route::get('webmin/lulusan/create', [LulusanController::class, 'create'])->name('lulusan.create');
    Route::post('webmin/lulusan', [LulusanController::class, 'store'])->name('lulusan.store');
    Route::get('webmin/lulusan/{lulusan}/edit', [LulusanController::class, 'edit'])->name('lulusan.edit');
    Route::put('webmin/lulusan/{lulusan}', [LulusanController::class, 'update'])->name('lulusan.update');
    Route::get('webmin/lulusan/template', [LulusanController::class, 'DownloadTemplate'])->name('lulusan.template');
    Route::get('webmin/lulusan/import', [LulusanController::class, 'import'])->name('lulusan.import');
    Route::post('webmin/lulusan/impview', [LulusanController::class, 'importView'])->name('lulusan.impview');
    Route::post('webmin/lulusan/import', [LulusanController::class, 'importData'])->name('lulusan.impData');

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

    //Ajar Route
    Route::get('webmin/ajar', [AjarController::class, 'index'])->name('ajar.index');
    Route::get('webmin/ajar/create', [AjarController::class, 'create'])->name('ajar.create');
    Route::post('webmin/ajar', [AjarController::class, 'store'])->name('ajar.store');
    Route::get('webmin/ajar/{ajar}/edit', [AjarController::class, 'edit'])->name('ajar.edit');
    Route::put('webmin/ajar/{ajar}', [AjarController::class, 'update'])->name('ajar.update');
    Route::delete('webmin/ajar/{ajar}', [AjarController::class, 'destroy'])->name('ajar.destroy');

    //Batch Route
    Route::resources(['webmin/batch' => BatchController::class]);

    //Daftar Skripsi Route
    Route::get('webmin/skripsi', [SkripsiController::class, 'index'])->name('skripsi.index');
    Route::get('webmin/skripsi/create', [SkripsiController::class, 'create'])->name('skripsi.create');
    Route::post('webmin/skripsi', [SkripsiController::class, 'store'])->name('skripsi.store');
    Route::get('webmin/skripsi/{skripsi}/edit', [SkripsiController::class, 'edit'])->name('skripsi.edit');
    Route::put('webmin/skripsi/{skripsi}', [SkripsiController::class, 'update'])->name('skripsi.update');
    Route::get('webmin/skripsi/{skripsi}/form', [SkripsiController::class, 'form'])->name('skripsi.form');
    Route::get('webmin/skripsi/{skripsi}/setbimbing', [SkripsiController::class, 'setpembimbing'])->name('skripsi.set.pembimbing');
    Route::get('webmin/skripsi/{skripsi}/addbimbing', [SkripsiController::class, 'addpembimbing'])->name('skripsi.add.pembimbing');
    Route::get('webmin/skripsi/{skripsi}/formbimbing', [SkripsiController::class, 'formpembimbing'])->name('skripsi.form.pembimbing');
    Route::get('webmin/skripsi/penugasan/{skripsi}', [SkripsiController::class, 'penugasan'])->name('skripsi.surat.tugas');
    Route::post('webmin/skripsi/penerbitan/{skripsi}', [SkripsiController::class, 'penerbitan'])->name('skripsi.surat.penerbitan');
    Route::delete('webmin/skripsi/pembimbing/{skripsi}', [SkripsiController::class, 'destroybimbing'])->name('skripsi.destroy.pembimbing');
    // Route::put('webmin/skripsi/setbimbing/{skripsi}', [SkripsiController::class, 'updatebimbing'])->name('skripsi.update.bimbing');
    Route::post('webmin/skripsi/setbimbing/{skripsi}', [SkripsiController::class, 'updatebimbing'])->name('skripsi.update.bimbing');
    Route::get('webmin/skripsi/{skripsi}/approve', [SkripsiController::class, 'persetujuan'])->name('skripsi.persetujuan');
    Route::put('webmin/skripsi/status/{skripsi}', [SkripsiController::class, 'updatestatus'])->name('skripsi.update.status');

    //Seminar Skripsi Route
    Route::get('webmin/seminar', [SeminarController::class, 'index'])->name('seminar.index');
    Route::get('webmin/seminar/create', [SeminarController::class, 'create'])->name('seminar.create');
    Route::post('webmin/seminar', [SeminarController::class, 'store'])->name('seminar.store');
    Route::get('webmin/seminar/{seminar}/edit', [SeminarController::class, 'edit'])->name('seminar.edit');
    Route::put('webmin/seminar/{seminar}', [SeminarController::class, 'update'])->name('seminar.update');
    Route::get('webmin/seminar/penguji/{seminar}', [SeminarController::class, 'penguji'])->name('seminar.penguji');
    Route::get('webmin/seminar/penguji/{seminar}/add', [SeminarController::class, 'addpenguji'])->name('seminar.penguji.add');
    Route::post('webmin/seminar/penguji/{seminar}', [SeminarController::class, 'savePenguji'])->name('seminar.penguji.save');
    Route::delete('webmin/seminar/penguji/{seminar}', [SeminarController::class, 'destroyPenguji'])->name('seminar.penguji.destroy');
    Route::get('webmin/seminar/status/{seminar}', [SeminarController::class, 'status'])->name('seminar.status');
    Route::put('webmin/seminar/status/{seminar}', [SeminarController::class, 'updateStatus'])->name('seminar.status.update');
    Route::put('webmin/seminar/penerbitan/{seminar}', [SeminarController::class, 'penerbitan'])->name('seminar.penerbitan.save');
    Route::get('webmin/seminar/formulir/{seminar}', [SeminarController::class, 'formulir'])->name('seminar.formulir');
    Route::get('webmin/seminar/formuji/{seminar}', [SeminarController::class, 'formuji'])->name('seminar.formuji');
    Route::get('webmin/seminar/penugasan/{seminar}', [SeminarController::class, 'penugasan'])->name('seminar.penugasan');
    Route::get('webmin/seminar/berita/{seminar}', [SeminarController::class, 'berita'])->name('seminar.berita');
    Route::get('webmin/seminar/jadwal', [SeminarController::class, 'jadwal'])->name('seminar.jadwal');

    //Seminar Hasil Routes
    Route::get('webmin/semhas', [SemhasController::class, 'index'])->name('semhas.index');
    Route::get('webmin/semhas/create', [SemhasController::class, 'create'])->name('semhas.create');
    Route::post('webmin/semhas', [SemhasController::class, 'store'])->name('semhas.store');
    Route::get('webmin/semhas/{semhas}/edit', [SemhasController::class, 'edit'])->name('semhas.edit');
    Route::put('webmin/semhas/{semhas}', [SemhasController::class, 'update'])->name('semhas.update');
    Route::get('webmin/semhas/formulir/{semhas}', [SemhasController::class, 'formulir'])->name('seminar.formulir');
    Route::get('webmin/semhas/penguji/{semhas}', [SemhasController::class, 'penguji'])->name('seminar.penguji');
    Route::get('webmin/semhas/penguji/{semhas}/add', [SemhasController::class, 'addpenguji'])->name('seminar.penguji.add');
    Route::post('webmin/semhas/penguji/{semhas}', [SemhasController::class, 'savePenguji'])->name('seminar.penguji.save');
    Route::delete('webmin/semhas/penguji/{semhas}', [SemhasController::class, 'destroyPenguji'])->name('seminar.penguji.destroy');
    Route::get('webmin/semhas/status/{semhas}', [SemhasController::class, 'status'])->name('semhas.status');
    Route::put('webmin/semhas/status/{semhas}', [SemhasController::class, 'updateStatus'])->name('semhas.status.update');
    Route::put('webmin/semhas/penerbitan/{semhas}', [SemhasController::class, 'penerbitan'])->name('semhas.penerbitan.save');
    Route::get('webmin/semhas/formulir/{semhas}', [SemhasController::class, 'formulir'])->name('semhas.formulir');
    Route::get('webmin/semhas/formuji/{semhas}', [SemhasController::class, 'formuji'])->name('semhas.formuji');
    Route::get('webmin/semhas/penugasan/{semhas}', [SemhasController::class, 'penugasan'])->name('semhas.penugasan');
    Route::get('webmin/semhas/berita/{semhas}', [SemhasController::class, 'berita'])->name('semhas.berita');
    Route::get('webmin/semhas/jadwal', [SemhasController::class, 'jadwal'])->name('semhas.jadwal');

    //PI / KP Routes
    // Route::resources(['webmin/kppi' => PiController::class]);
    Route::get('webmin/kppi', [PiController::class, 'index'])->name('kppi.index');
    Route::get('webmin/kppi/create', [PiController::class, 'create'])->name('kppi.create');
    Route::post('webmin/kppi', [PiController::class, 'store'])->name('kppi.store');
    Route::get('webmin/kppi/{kppi}/edit', [PiController::class, 'edit'])->name('kppi.edit');
    Route::put('webmin/kppi/{kppi}', [PiController::class, 'update'])->name('kppi.update');
    Route::get('webmin/kppi/formulir/{kppi}', [PiController::class, 'formulir'])->name('kppi.formulir');
    Route::get('webmin/kppi/status/{kppi}', [PiController::class, 'status'])->name('kppi.status');
    Route::put('webmin/kppi/status/{kppi}', [PiController::class, 'updateStatus'])->name('kppi.status.update');

    //Surat PI Routes
    // Route::resources(['webmin/suratpi' => SuratPIController::class]);
    Route::get('webmin/suratpi', [SuratPIController::class, 'index'])->name('suratpi.index');
    Route::get('webmin/suratpi/create', [SuratPIController::class, 'create'])->name('suratpi.create');
    Route::post('webmin/suratpi', [SuratPIController::class, 'store'])->name('suratpi.store');
    Route::get('webmin/suratpi/{suratpi}/edit', [SuratPIController::class, 'edit'])->name('suratpi.edit');
    Route::put('webmin/suratpi/{suratpi}', [SuratPIController::class, 'update'])->name('suratpi.update');
    Route::put('webmin/suratpi/status/{suratpi}', [SuratPIController::class, 'status'])->name('suratpi.status');
    Route::get('webmin/suratpi/surat/{suratpi}', [SuratPIController::class, 'cetak'])->name('suratpi.cetak');

    //Surat Observasi Routes
    // Route::resources(['webmin/suratobservasi' => SuratObservasiController::class]);
    Route::get('webmin/suratobservasi', [SuratObservasiController::class, 'index'])->name('suratobservasi.index');
    Route::get('webmin/suratobservasi/create', [SuratObservasiController::class, 'create'])->name('suratobservasi.create');
    Route::post('webmin/suratobservasi', [SuratObservasiController::class, 'store'])->name('suratobservasi.store');
    Route::get('webmin/suratobservasi/{suratobservasi}/edit', [SuratObservasiController::class, 'edit'])->name('suratobservasi.edit');
    Route::put('webmin/suratobservasi/{suratobservasi}', [SuratObservasiController::class, 'update'])->name('suratobservasi.update');
    Route::put('webmin/suratobservasi/status/{suratobservasi}', [SuratObservasiController::class, 'status'])->name('suratobservasi.status');
    Route::get('webmin/suratobservasi/surat/{suratobservasi}', [SuratObservasiController::class, 'cetak'])->name('suratobservasi.cetak');

    //Surat Ambil Data Routes
    // Route::resources(['webmin/suratambildata' => SuratAmbilDataController::class]);
    Route::get('webmin/suratambildata', [SuratAmbilDataController::class, 'index'])->name('suratambildata.index');
    Route::get('webmin/suratambildata/create', [SuratAmbilDataController::class, 'create'])->name('suratambildata.create');
    Route::post('webmin/suratambildata', [SuratAmbilDataController::class, 'store'])->name('suratambildata.store');
    Route::get('webmin/suratambildata/{suratambildata}/edit', [SuratAmbilDataController::class, 'edit'])->name('suratambildata.edit');
    Route::put('webmin/suratambildata/{suratambildata}', [SuratAmbilDataController::class, 'update'])->name('suratambildata.update');
    Route::put('webmin/suratambildata/status/{suratambildata}', [SuratAmbilDataController::class, 'status'])->name('suratambildata.status');
    Route::get('webmin/suratambildata/surat/{suratambildata}', [SuratAmbilDataController::class, 'cetak'])->name('suratambildata.cetak');
});

Route::get('uji', [UjiController::class, 'index'])->name('uji.index');
