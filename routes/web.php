<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Koordinator\ArsipPKLController;
use App\Http\Controllers\Koordinator\AssignDospemController;
use App\Http\Controllers\Koordinator\DokumenController;
use App\Http\Controllers\Koordinator\PengumumanController;
use App\Http\Controllers\Koordinator\DosenPembimbingController;
use App\Http\Controllers\Koordinator\AssignMhsBimbinganController;
use App\Http\Controllers\Koordinator\BebanBimbinganController;
use App\Http\Controllers\Koordinator\ExportController;
use App\Http\Controllers\Koordinator\MahasiswaController;
use App\Http\Controllers\Koordinator\PKLController as KoordinatorPKLController;
use App\Http\Controllers\Koordinator\SeminarPKLController as KoordinatorSeminarPKLController;
use App\Http\Controllers\Koordinator\RiwayatPKLController as KoordinatorRiwayatPKLController;


use App\Http\Controllers\PKLController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Koordinator\PeriodePKLController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RiwayatPKLController;
use App\Http\Controllers\SeminarPKLController;
use App\Models\ArsipPKL;
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
        $data_pengumuman = DB::table('pengumuman')->select(['deskripsi','lampiran','updated_at'])->get();
        $data_dokumen = DB::table('dokumen')->select(['deskripsi','lampiran','updated_at'])->get();
        return view('landing',[
            'data_pengumuman' => $data_pengumuman,
            'data_dokumen' => $data_dokumen,
        ]);
    })->name('landing');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

route::middleware('auth')->group(function () {
    Route::middleware('data.updated')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile/update_password', [ProfileController::class, 'updatePassword']);
        Route::put('/profile/update_nowa', [ProfileController::class, 'updateNoWa']);
        Route::put('/profile/update_email', [ProfileController::class, 'updateEmail']);

        Route::post('/tmp_upload_foto_profil', [ProfileController::class, 'tmpUploadFotoProfil']);
        Route::delete('/tmp_delete_foto_profil', [ProfileController::class, 'tmpDeleteFotoProfil']);
        Route::put('/profile/update_foto_profil', [ProfileController::class, 'updateFotoProfil']);

        Route::post('/tmp_upload_irs', [PKLController::class, 'tmpUpload']);
        Route::delete('/tmp_delete_irs', [PKLController::class, 'tmpDelete']);

    });

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/preview/{filename}', [FileController::class, 'preview'])->where('filename', '.*');
    Route::get('/download_file/{filename}', [FileController::class, 'downloadFile'])->where('filename', '.*');


});

Route::middleware(['auth', 'is.admin:1'])->group(function () {
    Route::put('/profile/update_golongan', [ProfileController::class, 'updateGolongan']);
    Route::put('/profile/update_jabatan', [ProfileController::class, 'updateJabatan']);

    Route::get('/dospem/kelola_dospem/', [DosenPembimbingController::class, 'index']);
    Route::post('/dospem/kelola_dospem/tambah', [DosenPembimbingController::class, 'store']);
    Route::get('/dospem/update_tabel_dospem', [DosenPembimbingController::class, 'update_tabel_dospem']);
    Route::put('/dospem/kelola_dospem/update', [DosenPembimbingController::class, 'update']);
    Route::delete('/dospem/kelola_dospem/{dosenPembimbing}/delete', [DosenPembimbingController::class, 'destroy']);

    Route::get('/dospem/assign_mhs_bimbingan/', [AssignMhsBimbinganController::class, 'index']);
    Route::get('/dospem/assign_mhs_bimbingan/update_tabel_dospem', [AssignMhsBimbinganController::class, 'update_tabel_dospem']);
    Route::get('/dospem/assign_mhs_bimbingan/{id_dospem}/get_data_mhs', [AssignMhsBimbinganController::class, 'get_data_mhs']);
    Route::get('/dospem/assign_mhs_bimbingan/{nim}/get_data_pkl', [AssignMhsBimbinganController::class, 'get_data_pkl']);
    Route::post('/dospem/assign_mhs_bimbingan/{id_dospem}/update_mhs_bimbingan', [AssignMhsBimbinganController::class, 'update_mhs_bimbingan']);

    Route::get('/dospem/beban_bimbingan/', [BebanBimbinganController::class, 'index']);
    Route::get('/dospem/beban_bimbingan/update_tabel_index', [BebanBimbinganController::class, 'update_tabel_index']);
    Route::get('/dospem/beban_bimbingan/get_bimbingan/', [BebanBimbinganController::class, 'get_bimbingan']);

    Route::get('/mhs/kelola_mhs/', [MahasiswaController::class, 'index']);
    Route::post('/mhs/kelola_mhs/tambah', [MahasiswaController::class, 'store']);
    Route::post('/mhs/kelola_mhs/import', [MahasiswaController::class, 'import']);
    Route::get('/mhs/lelola_mhs/update_tabel_mhs', [MahasiswaController::class, 'update_tabel_mhs']);
    Route::put('/mhs/kelola_mhs/update', [MahasiswaController::class, 'update']);
    Route::delete('/mhs/kelola_mhs/{mahasiswa}/delete', [MahasiswaController::class, 'destroy']);
    Route::put('/mhs/kelola_mhs/{nim}/reset_pass', [MahasiswaController::class, 'reset_password']);
    Route::get('/mhs/kelola_mhs/{nim}/get_data_pkl', [MahasiswaController::class, 'get_data_pkl']);
    Route::get('/mhs/kelola_mhs/{id_dospem}/get_data_dospem', [MahasiswaController::class, 'get_data_dospem']);

    Route::get('/mhs/assign_dospem/', [AssignDospemController::class, 'index']);
    Route::post('/mhs/assign_dospem/{nim}/update_dospem', [AssignDospemController::class, 'update_dospem']);

    Route::get('/mhs/daftar_mhs_belum_lulus/', [MahasiswaController::class, 'index_belum_lulus']);
    Route::get('/mhs/daftar_mhs_belum_lulus/update_tabel_belum_lulus', [MahasiswaController::class, 'update_tabel_belum_lulus']);
    Route::put('/mhs/daftar_mhs_belum_lulus/reset_status', [MahasiswaController::class, 'reset_status']);

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
    
    Route::get('/seminar/jadwal_seminar', [KoordinatorSeminarPKLController::class, 'index_jadwal_seminar']);
    Route::post('/seminar/jadwal_seminar/tambah', [KoordinatorSeminarPKLController::class, 'tambah_jadwal_seminar']);
    Route::put('/seminar/jadwal_seminar/{seminar_pkl}/update', [KoordinatorSeminarPKLController::class, 'update_jadwal_seminar']);
    Route::get('/seminar/jadwal_seminar/update_tabel_jadwal', [KoordinatorSeminarPKLController::class, 'update_tabel_jadwal']);
    Route::get('/seminar/jadwal_seminar/get_mhs_aktif', [KoordinatorSeminarPKLController::class, 'get_mhs_aktif']);
    Route::get('/seminar/jadwal_seminar/export', [KoordinatorSeminarPKLController::class, 'export_jadwal_seminar']);
    Route::get('/seminar/jadwal_seminar/export_mhs_aktif', [KoordinatorSeminarPKLController::class, 'export_mhs_aktif']);
    Route::post('/seminar/jadwal_seminar/import', [KoordinatorSeminarPKLController::class, 'import_jadwal_seminar']);
    Route::delete('/seminar/jadwal_seminar/{seminar_pkl}/delete', [KoordinatorSeminarPKLController::class, 'delete_jadwal_seminar']);

    Route::get('/arsip_pkl', [ArsipPKLController::class, 'index']);
    Route::get('/arsip_pkl/update_tabel_arsip', [ArsipPKLController::class, 'update_tabel_arsip']);
    Route::post('/arsip_pkl/export_nilai', [ArsipPKLController::class, 'export_arsip_pkl']);

    Route::get('/cetak_sk', [ExportController::class, 'index']);
    Route::get('/cetak_sk/export', [ExportController::class, 'export']);

    Route::get('/riwayat_pkl', [KoordinatorRiwayatPKLController::class, 'index']);
    Route::get('/riwayat_pkl/{nim}/get_data_riwayat', [KoordinatorRiwayatPKLController::class, 'getDataRiwayat']);

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
    Route::middleware('status.mhs:Baru')->group(function () {
        Route::get('/update_data', [AuthController::class, 'editData'])->name('update_data');
        Route::put('/update_data', [AuthController::class, 'updateDataMahasiswa']);
    });

    Route::get('/pkl', [PKLController::class, 'index'])->middleware('status.mhs:Nonaktif,Aktif')->name('pkl.index');
    Route::put('/pkl/{pkl}/update', [PKLController::class, 'updateData']);
    Route::get('/riwayat', [RiwayatPKLController::class, 'index'])->middleware('data.updated');

    Route::middleware('status.mhs:Nonaktif')->group(function () {
        Route::get('/registrasi', [PKLController::class, 'registrasi'])->name('registrasi');
        Route::post('/registrasi', [PKLController::class, 'submitRegistrasi'])->name('registrasi.submit');
    });

    Route::middleware('status.mhs:Aktif')->group(function () {
        Route::get('/seminar', [SeminarPKLController::class, 'index'])->name('seminar.index');
        Route::post('/seminar/daftar', [SeminarPKLController::class, 'daftarSeminar']);
        Route::post('/seminar/daftar_ulang', [SeminarPKLController::class, 'daftarUlangSeminar']);

        Route::get('/laporan', [PKLController::class, 'laporan']);
        Route::post('/laporan/kirim', [PKLController::class, 'kirimLaporan']);
    });

    Route::get('/profile/verifikasi_email', [ProfileController::class, 'verifikasiEmail'])->name('profile.verifikasi_email');
    Route::post('/email/send_otp', [MailController::class, 'sendOtp'])->name('send_otp');
    Route::post('/email/verifikasi', [MailController::class, 'verifikasiOtp'])->name('verifikasi_email');

});