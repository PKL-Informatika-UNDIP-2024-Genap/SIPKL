<?php

use App\Http\Controllers\Koordinator\DokumenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Koordinator\PengumumanController;
use App\Http\Controllers\Koordinator\DosenPembimbingController;
use App\Http\Controllers\PKLController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::middleware('guest')->group(function () {
    Route::get('/', function () {
        $data_pengumuman = DB::table('pengumuman')->get();
        $data_dokumen = DB::table('dokumen')->get();
        return view('landing',[
            'data_pengumuman' => $data_pengumuman,
            'data_dokumen' => $data_dokumen,
        ]);
    })->name('landing');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

route::middleware('auth')->group(function () {
    Route::middleware('data.updated')->group(function () {
        Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    });
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/preview/{filename}', [FileController::class, 'preview'])->where('filename', '.*');
});

Route::middleware(['auth', 'is.admin:1'])->group(function () {
    Route::get('/dosbing/kelola_dosbing/', [DosenPembimbingController::class, 'index']);
    Route::post('/dosbing/kelola_dosbing/tambah', [DosenPembimbingController::class, 'store']);
    Route::get('/dosbing/update_tabel_dosbing', [DosenPembimbingController::class, 'update_tabel_dosbing']);
    Route::put('/dosbing/kelola_dosbing/update', [DosenPembimbingController::class, 'update']);
    Route::delete('/dosbing/kelola_dosbing/{dosenPembimbing}/delete', [DosenPembimbingController::class, 'destroy']);

    Route::get('/informasi/kelola_pengumuman', [PengumumanController::class, 'index']);
    Route::post('/informasi/kelola_pengumuman/tambah', [PengumumanController::class, 'store']);
    Route::get('/informasi/update_tabel_pengumuman', [PengumumanController::class, 'update_tabel_pengumuman']);
    Route::put('/informasi/kelola_pengumuman/{pengumuman}/update', [PengumumanController::class, 'update']);
    Route::delete('/informasi/kelola_pengumuman/{pengumuman}/delete', [PengumumanController::class, 'destroy']);

    Route::get('/informasi/kelola_dokumen', [DokumenController::class, 'index']);
    Route::post('/informasi/kelola_dokumen/tambah', [DokumenController::class, 'store']);
    Route::get('/informasi/update_tabel_dokumen', [DokumenController::class, 'update_tabel_dokumen']);
    Route::put('/informasi/kelola_dokumen/{dokumen}/update', [DokumenController::class, 'update']);
    Route::delete('/informasi/kelola_dokumen/{dokumen}/delete', [DokumenController::class, 'destroy']);
});

Route::middleware(['auth', 'is.admin:0'])->group(function () {
    Route::get('/update-data', [LoginController::class, 'editData'])->name('update-data');
    Route::put('/update-data', [LoginController::class, 'updateDataMahasiswa']);

    Route::get('/registrasi', [PKLController::class, 'registrasi'])->name('registrasi');
    Route::put('/registrasi', [PKLController::class, 'submitRegistrasi'])->name('registrasi.submit');

    Route::get('/pkl', [PKLController::class, 'index'])->name('pkl.index');
    Route::get('/seminar', function(){
        return view('mahasiswa.seminar.index');
    })->name('seminar.index');

});
