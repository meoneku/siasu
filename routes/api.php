<?php

use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\MahasiswaController;
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
Route::post('/getDataSkripsi', [MahasiswaController::class, 'getDataSkripsi'])->name('getDataSkripsi.api');
Route::post('/getDataSeminar', [MahasiswaController::class, 'getDataSeminar'])->name('getDataSeminar.api');
