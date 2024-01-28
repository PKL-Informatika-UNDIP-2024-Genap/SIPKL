<?php

use App\Http\Controllers\Koordinator\AssignDospemController;
use App\Http\Controllers\Koordinator\DokumenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Koordinator\PengumumanController;
use App\Http\Controllers\Koordinator\DosenPembimbingController;
use App\Http\Controllers\Koordinator\AssignMhsBimbinganController;
use App\Http\Controllers\Koordinator\MahasiswaController;
use App\Http\Controllers\PKLController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Koordinator\PeriodePKLController;
use App\Http\Controllers\RiwayatPKLController;
use App\Http\Controllers\SeminarPKLController;
use App\Models\PeriodePKL;

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
    Route::get('/download_file/{filename}', [FileController::class, 'downloadFile'])->where('filename', '.*');

    Route::post('/tmp_upload', [PKLController::class, 'tmpUpload']);
    Route::delete('/tmp_delete', [PKLController::class, 'tmpDelete']);
});

Route::middleware(['auth', 'is.admin:1'])->group(function () {
    Route::get('/dospem/kelola_dospem/', [DosenPembimbingController::class, 'index']);
    Route::post('/dospem/kelola_dospem/tambah', [DosenPembimbingController::class, 'store']);
    Route::get('/dospem/update_tabel_dospem', [DosenPembimbingController::class, 'update_tabel_dospem']);
    Route::put('/dospem/kelola_dospem/update', [DosenPembimbingController::class, 'update']);
    Route::delete('/dospem/kelola_dospem/{dosenPembimbing}/delete', [DosenPembimbingController::class, 'destroy']);

    Route::get('/dospem/assign_mhs_bimbingan/', [AssignMhsBimbinganController::class, 'index']);
    Route::get('/dospem/assign_mhs_bimbingan/update_tabel_dospem', [AssignMhsBimbinganController::class, 'update_tabel_dospem']);
    Route::get('/dospem/assign_mhs_bimbingan/{nip}/get_data_mhs', [AssignMhsBimbinganController::class, 'get_data_mhs']);
    Route::get('/dospem/assign_mhs_bimbingan/{nim}/get_data_pkl', [AssignMhsBimbinganController::class, 'get_data_pkl']);
    Route::post('/dospem/assign_mhs_bimbingan/{nip}/update_mhs_bimbingan', [AssignMhsBimbinganController::class, 'update_mhs_bimbingan']);


    Route::get('/mhs/kelola_mhs/', [MahasiswaController::class, 'index']);
    Route::post('/mhs/kelola_mhs/tambah', [MahasiswaController::class, 'store']);
    Route::post('/mhs/kelola_mhs/import', [MahasiswaController::class, 'import']);
    Route::get('/mhs/update_tabel_mhs', [MahasiswaController::class, 'update_tabel_mhs']);
    Route::put('/mhs/kelola_mhs/update', [MahasiswaController::class, 'update']);
    Route::delete('/mhs/kelola_mhs/{mahasiswa}/delete', [MahasiswaController::class, 'destroy']);
    Route::put('/mhs/kelola_mhs/{nim}/reset_pass', [MahasiswaController::class, 'reset_password']);
    Route::get('/mhs/kelola_mhs/{nim}/get_data_pkl', [MahasiswaController::class, 'get_data_pkl']);
    Route::get('/mhs/kelola_mhs/{nip}/get_data_dospem', [MahasiswaController::class, 'get_data_dospem']);
    
    Route::get('/mhs/assign_dospem/', [AssignDospemController::class, 'index']);
    Route::post('/mhs/assign_dospem/{nim}/update_dospem', [AssignDospemController::class, 'update_dospem']);

    Route::get('/pkl/kelola_periode', [PeriodePKLController::class, 'index']);


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
    Route::get('/update_data', [LoginController::class, 'editData'])->name('update_data');
    Route::put('/update_data', [LoginController::class, 'updateDataMahasiswa']);

    Route::get('/registrasi', [PKLController::class, 'registrasi'])->middleware('status.mhs:Nonaktif')->name('registrasi');
    Route::post('/registrasi', [PKLController::class, 'submitRegistrasi'])->name('registrasi.submit');

    Route::get('/pkl', [PKLController::class, 'index'])->middleware('data.updated')->name('pkl.index');

    Route::get('/seminar', [SeminarPKLController::class, 'index'])->middleware('status.mhs:Aktif')->name('seminar.index');

    Route::get('/riwayat', [RiwayatPKLController::class, 'index'])->middleware('data.updated');
});
