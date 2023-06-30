<?php

use App\Http\Controllers\Api\BannerApi;
use App\Http\Controllers\Api\BeritaApi;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\HmpApi;
use App\Http\Controllers\Api\InventarisController;
use App\Http\Controllers\Api\KategoriApi;
use App\Http\Controllers\Api\KemahasiswaanApi;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\ProdiApi;
use App\Http\Controllers\Api\VisiApi;
use App\Http\Controllers\Api\ProfilApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/getDosen', [DosenController::class, 'getDosen'])->name('getdosen.api');
Route::post('/getMahasiswa', [MahasiswaController::class, 'getMahasiswa'])->name('getMahasiswa.api');
Route::get('/getMahasiswaId', [MahasiswaController::class, 'getMahasiswaId'])->name('getMahasiswaId.api');
Route::post('/getDataSkripsi', [MahasiswaController::class, 'getDataSkripsi'])->name('getDataSkripsi.api');
Route::post('/getDataSeminar', [MahasiswaController::class, 'getDataSeminar'])->name('getDataSeminar.api');
Route::post('/getNoInventaris', [InventarisController::class, 'getNoInventaris'])->name('getNoInventaris.api');
Route::get('/pengumuman/makeSlug', [PengumumanController::class, 'makeSlug'])->name('api.pengumuman.makeslug');
Route::get('/kategori/makeSlug', [KategoriApi::class, 'makeSlug'])->name('api.kategori.makeslug');
Route::get('/berita/makeSlug', [BeritaApi::class, 'makeSlug'])->name('api.berita.makeslug');
Route::get('/visi/makeSlug', [VisiApi::class, 'makeSlug'])->name('api.visi.makeslug');
Route::get('/profil/makeSlug', [ProfilApi::class, 'makeSlug'])->name('api.profil.makeslug');
Route::get('/prodi/makeSlug', [ProdiApi::class, 'makeSlug'])->name('api.prodi.makeslug');
Route::get('/hmp/makeSlug', [HmpApi::class, 'makeSlug'])->name('api.hmp.makeslug');
Route::get('/kemahasiswaan/makeSlug', [KemahasiswaanApi::class, 'makeSlug'])->name('api.kemahsiswaan.makeslug');
