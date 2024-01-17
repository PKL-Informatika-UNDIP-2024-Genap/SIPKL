<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Koordinator\DosenPembimbingController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard', [LoginController::class, 'dashboard']);
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::middleware(['auth', 'is.admin:1'])->group(function () {
    Route::get('/dosbing/kelola_dosbing/', [DosenPembimbingController::class, 'index']);
    Route::post('/dosbing/kelola_dosbing/tambah', [DosenPembimbingController::class, 'store']);
    Route::get('/dosbing/update_tabel_dosbing', [DosenPembimbingController::class, 'update_tabel_dosbing']);
});

Route::middleware(['auth', 'is.admin:0'])->group(function () {
    
});