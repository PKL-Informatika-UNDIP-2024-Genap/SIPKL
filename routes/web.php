<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArsipPKLController;

use App\Http\Controllers\Koordinator\AssignDospemController;
use App\Http\Controllers\Koordinator\DokumenController;
use App\Http\Controllers\Koordinator\PengumumanController;
use App\Http\Controllers\Koordinator\InformasiLainController;
use App\Http\Controllers\Koordinator\DosenPembimbingController;
use App\Http\Controllers\Koordinator\AssignMhsBimbinganController;
use App\Http\Controllers\Koordinator\BebanBimbinganController;
use App\Http\Controllers\Koordinator\CetakSKController;
use App\Http\Controllers\Koordinator\MahasiswaController;
use App\Http\Controllers\Koordinator\PeriodePKLController;
use App\Http\Controllers\Koordinator\PKLController as KoordinatorPKLController;
use App\Http\Controllers\Koordinator\SeminarPKLController as KoordinatorSeminarPKLController;
use App\Http\Controllers\Koordinator\RiwayatPKLController as KoordinatorRiwayatPKLController;

use App\Http\Controllers\Mahasiswa\PKLController as MahasiswaPKLController ;
use App\Http\Controllers\Mahasiswa\SeminarPKLController as MahasiswaSeminarPKLController;
use App\Http\Controllers\Mahasiswa\RiwayatPKLController as MahasiswaRiwayatPKLController;

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
    Route::get('/', [AuthController::class, 'landing'])->name('landing');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

route::middleware('auth')->group(function () {
    Route::middleware('data.updated')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile/update_password', [ProfileController::class, 'update_password']);
        Route::put('/profile/update_nowa', [ProfileController::class, 'update_no_wa']);
        Route::put('/profile/update_email', [ProfileController::class, 'update_email']);

        Route::post('/profile/update_foto_profil', [ProfileController::class, 'update_foto_profil']);

    });

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/preview/{filename}', [FileController::class, 'preview'])->where('filename', '.*');
    Route::get('/download_file/{filename}', [FileController::class, 'download_file'])->where('filename', '.*');

});

Route::middleware(['auth', 'is.admin:1'])->group(function () {
    Route::put('/profile/update_golongan', [ProfileController::class, 'update_golongan']);
    Route::put('/profile/update_jabatan', [ProfileController::class, 'update_jabatan']);

    Route::get('/dospem/kelola_dospem/', [DosenPembimbingController::class, 'index']);
    Route::post('/dospem/kelola_dospem/tambah', [DosenPembimbingController::class, 'store']);
    Route::get('/dospem/update_tabel_dospem', [DosenPembimbingController::class, 'update_tabel_dospem']);
    Route::put('/dospem/kelola_dospem/update', [DosenPembimbingController::class, 'update']);
    Route::delete('/dospem/kelola_dospem/{dosenPembimbing}/delete', [DosenPembimbingController::class, 'destroy']);

    Route::get('/dospem/assign_mhs_bimbingan/', [AssignMhsBimbinganController::class, 'index']);
    Route::get('/dospem/assign_mhs_bimbingan/update_tabel_dospem', [AssignMhsBimbinganController::class, 'update_tabel_dospem']);
    Route::get('/dospem/assign_mhs_bimbingan/{id_dospem}/get_data_mhs', [AssignMhsBimbinganController::class, 'get_data_mhs']);
    Route::post('/dospem/assign_mhs_bimbingan/{id_dospem}/update_mhs_bimbingan', [AssignMhsBimbinganController::class, 'update_mhs_bimbingan']);

    Route::get('/dospem/beban_bimbingan/', [BebanBimbinganController::class, 'index']);
    Route::get('/dospem/beban_bimbingan/update_tabel_index', [BebanBimbinganController::class, 'update_tabel_index']);
    Route::get('/dospem/beban_bimbingan/get_bimbingan/', [BebanBimbinganController::class, 'get_bimbingan']);

    Route::get('/mhs/kelola_mhs', [MahasiswaController::class, 'index']);
    Route::post('/mhs/kelola_mhs/tambah', [MahasiswaController::class, 'store']);
    Route::post('/mhs/kelola_mhs/import', [MahasiswaController::class, 'import']);
    Route::get('/mhs/lelola_mhs/update_tabel_mhs', [MahasiswaController::class, 'update_tabel_mhs']);
    Route::put('/mhs/kelola_mhs/update', [MahasiswaController::class, 'update']);
    Route::delete('/mhs/kelola_mhs/{mahasiswa}/delete', [MahasiswaController::class, 'destroy']);
    Route::put('/mhs/kelola_mhs/{nim}/reset_pass', [MahasiswaController::class, 'reset_password']);
    Route::get('/mhs/kelola_mhs/get_data_pkl_dospem', [MahasiswaController::class, 'get_data_pkl_dospem']);

    Route::get('/mhs/assign_dospem/', [AssignDospemController::class, 'index']);
    Route::post('/mhs/assign_dospem/{nim}/update_dospem', [AssignDospemController::class, 'update_dospem']);

    Route::get('/mhs/daftar_mhs_belum_selesai/', [MahasiswaController::class, 'index_belum_selesai']);
    Route::get('/mhs/daftar_mhs_belum_selesai/update_tabel_belum_selesai', [MahasiswaController::class, 'update_tabel_belum_selesai']);
    Route::put('/mhs/daftar_mhs_belum_selesai/reset_status', [MahasiswaController::class, 'reset_status']);

    Route::get('/pkl/kelola_periode', [PeriodePKLController::class, 'index']);
    Route::post('/pkl/kelola_periode/tambah', [PeriodePKLController::class, 'store']);
    Route::delete('/pkl/kelola_periode/hapus', [PeriodePKLController::class, 'destroy']);
    Route::put('/pkl/kelola_periode/update', [PeriodePKLController::class, 'update']);
    Route::get('/pkl/kelola_periode/update_tabel_periode', [PeriodePKLController::class, 'update_tabel_periode']);
    
    Route::get('/pkl/verifikasi_registrasi', [KoordinatorPKLController::class, 'index_verif_reg']);
    Route::post('/pkl/verifikasi_registrasi/{pkl}/terima', [KoordinatorPKLController::class, 'terima_registrasi']);
    Route::post('/pkl/verifikasi_registrasi/{pkl}/tolak', [KoordinatorPKLController::class, 'tolak_registrasi']);
    Route::get('/pkl/verifikasi_registrasi/update_tabel_registrasi', [KoordinatorPKLController::class, 'update_tabel_registrasi']);
    
    Route::get('/pkl/verifikasi_laporan', [KoordinatorPKLController::class, 'index_verif_laporan']);
    Route::post('/pkl/verifikasi_laporan/{pkl}/terima', [KoordinatorPKLController::class, 'terima_laporan']);
    Route::post('/pkl/verifikasi_laporan/{pkl}/tolak', [KoordinatorPKLController::class, 'tolak_laporan']);
    Route::get('/pkl/verifikasi_laporan/update_tabel_laporan', [KoordinatorPKLController::class, 'update_tabel_laporan']);
    
    Route::get('/pkl/assign_nilai', [KoordinatorPKLController::class, 'index_assign_nilai']);
    Route::post('/pkl/assign_nilai/{pkl}/assign', [KoordinatorPKLController::class, 'assign_nilai']);
    Route::get('/pkl/assign_nilai/update_tabel_nilai', [KoordinatorPKLController::class, 'update_tabel_nilai']);
    
    Route::get('/seminar/verifikasi_pengajuan', [KoordinatorSeminarPKLController::class, 'index_verif_pengajuan']);
    Route::post('/seminar/verifikasi_pengajuan/{seminar_pkl}/terima', [KoordinatorSeminarPKLController::class, 'terima_pengajuan']);
    Route::post('/seminar/verifikasi_pengajuan/{seminar_pkl}/tolak', [KoordinatorSeminarPKLController::class, 'tolak_pengajuan']);
    Route::get('/seminar/verifikasi_pengajuan/update_tabel_pengajuan', [KoordinatorSeminarPKLController::class, 'update_tabel_pengajuan']);
    
    Route::get('/seminar/jadwal_seminar', [KoordinatorSeminarPKLController::class, 'index_jadwal_seminar'])->name('koordinator.seminar.jadwal_seminar');
    Route::post('/seminar/jadwal_seminar/tambah', [KoordinatorSeminarPKLController::class, 'tambah_jadwal_seminar']);
    Route::put('/seminar/jadwal_seminar/{seminar_pkl}/update', [KoordinatorSeminarPKLController::class, 'update_jadwal_seminar']);
    Route::get('/seminar/jadwal_seminar/update_tabel_jadwal', [KoordinatorSeminarPKLController::class, 'update_tabel_jadwal']);
    Route::get('/seminar/jadwal_seminar/get_mhs_aktif', [KoordinatorSeminarPKLController::class, 'get_mhs_aktif']);
    Route::get('/seminar/jadwal_seminar/export', [KoordinatorSeminarPKLController::class, 'export_jadwal_seminar']);
    Route::get('/seminar/jadwal_seminar/export_mhs_aktif', [KoordinatorSeminarPKLController::class, 'export_mhs_aktif']);
    Route::post('/seminar/jadwal_seminar/import', [KoordinatorSeminarPKLController::class, 'import_jadwal_seminar']);
    Route::delete('/seminar/jadwal_seminar/{seminar_pkl}/delete', [KoordinatorSeminarPKLController::class, 'delete_jadwal_seminar']);

    Route::get('/arsip_pkl', [ArsipPKLController::class, 'index']);

    Route::get('/cetak_sk', [CetakSKController::class, 'index']);
    Route::post('/cetak_sk/export', [CetakSKController::class, 'export']);
    Route::get('/cetak_sk/riwayat', [CetakSKController::class, 'riwayat']);
    Route::post('/cetak_sk/riwayat/export', [CetakSKController::class, 'export_riwayat']);

    Route::get('/riwayat_pkl', [KoordinatorRiwayatPKLController::class, 'index']);
    Route::get('/riwayat_pkl/{nim}/get_data_riwayat', [KoordinatorRiwayatPKLController::class, 'get_data_riwayat']);

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

    Route::get('/informasi/kelola_informasi_lain', [InformasiLainController::class, 'index']);
    Route::put('/informasi/kelola_informasi_lain/{informasiLain}/update', [InformasiLainController::class, 'update']);
});

Route::middleware(['auth', 'is.admin:0'])->group(function () {
    Route::middleware('status.mhs:Baru')->group(function () {
        Route::get('/praregistrasi', [AuthController::class, 'praregistrasi'])->name('praregistrasi');
        Route::put('/submit_praregistrasi', [AuthController::class, 'submit_praregistrasi']);
    });

    Route::post('/dashboard/tutup_pesan', [AuthController::class, 'tutup_pesan']);

    Route::get('/pkl', [MahasiswaPKLController::class, 'index'])->middleware('status.mhs:Nonaktif,Aktif')->name('pkl.index');
    Route::put('/pkl/{pkl}/update', [MahasiswaPKLController::class, 'update_data']);
    Route::get('/seminar', [MahasiswaSeminarPKLController::class, 'index'])->name('seminar.index');
    Route::get('/seminar/jadwal', [MahasiswaSeminarPKLController::class, 'jadwal_seminar']);
    Route::get('/riwayat', [MahasiswaRiwayatPKLController::class, 'index'])->middleware('data.updated');

    Route::get('/registrasi', [MahasiswaPKLController::class, 'registrasi'])->name('registrasi');
    Route::middleware(['status.mhs:Nonaktif','has.pembimbing'])->group(function () {
        Route::post('/registrasi', [MahasiswaPKLController::class, 'submit_registrasi'])->name('registrasi.submit');
    });

    Route::middleware('status.mhs:Aktif,Lulus')->group(function () {
        Route::post('/seminar/daftar', [MahasiswaSeminarPKLController::class, 'daftar_seminar']);
        Route::post('/seminar/daftar_ulang', [MahasiswaSeminarPKLController::class, 'daftar_ulang_seminar']);

        Route::middleware('has.seminar')->group(function () {
            Route::get('/laporan', [MahasiswaPKLController::class, 'laporan']);
            Route::post('/laporan/kirim', [MahasiswaPKLController::class, 'kirim_laporan']);
        });
        
    });

    Route::middleware('status.mhs:Lulus')->group(function () {
        Route::get('/arsip', [ArsipPKLController::class, 'index']);
    });
    
});