<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\ArsipPKL;
use App\Models\Mahasiswa;
use App\Models\PKL;
use App\Models\PeriodePKL;
use App\Models\RiwayatPKL;
use App\Models\SeminarPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PKLController extends Controller
{
  // Verifikasi Registrasi
  public function index_verif_reg()
  {
    $data_mhs = PKL::whereRaw("pkl.status = 'Registrasi'")->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')->get();

    return view('koordinator.pkl.verifikasi_registrasi.index', [
      'data_mhs' => $data_mhs
    ]);
  }

  public function terima_registrasi(PKL $pkl)
  {
    $today = Carbon::now()->toDateString();

    $periode_pkl = PeriodePKL::select('id_periode')->whereDate('tgl_mulai', '<=', $today)
        ->whereDate('tgl_selesai', '>=', $today)
        ->orderBy('tgl_mulai', 'desc')
        ->first();
    
    if(!$periode_pkl){
      return response()->json([
        'message' => 'Tidak ada periode PKL yang aktif',
      ], 400);
    }

    $pkl->status = 'Aktif';
    $pkl->pesan = null;
    $pkl->save();

    Mahasiswa::where('nim', $pkl->nim)->update([
      'status' => 'Aktif',
      'periode_pkl' => $periode_pkl->id_periode,
    ]);

    return response()->json([
      'message' => 'Berhasil menerima registrasi',
    ], 200);
  }

  public function tolak_registrasi(PKL $pkl, Request $request)
  {
    $pkl->status = 'Praregistrasi';
    $pkl->pesan = $request->alasan_menolak;
    $pkl->save();

    return response()->json([
      'message' => 'Berhasil menolak registrasi',
    ], 200);
  }

  public function update_tabel_registrasi(){
    $data_mhs = PKL::whereRaw("pkl.status = 'Registrasi'")->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')->get();

    $view = view('koordinator.pkl.verifikasi_registrasi.update_tabel_registrasi', [
      'data_mhs' => $data_mhs
    ])->render();

    return response()->json([
      'view' => $view
    ]);
  }


  // Verifikasi Laporan
  public function index_verif_laporan()
  {
    $data_mhs = PKL::whereRaw("pkl.status = 'Laporan'")->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')->get();

    return view('koordinator.pkl.verifikasi_laporan.index', [
      'data_mhs' => $data_mhs
    ]);
  }

  public function terima_laporan(PKL $pkl)
  {
    $pkl->status = 'Selesai';
    $pkl->pesan = null;
    $pkl->tgl_verif_laporan = now();
    $pkl->save();

    Mahasiswa::where('nim', $pkl->nim)->update([
      'status' => 'Lulus',
    ]);

    return response()->json([
      'message' => 'Berhasil menerima laporan',
    ], 200);
  }

  public function tolak_laporan(PKL $pkl, Request $request)
  {
    $pkl->status = 'Aktif';
    $pkl->pesan = $request->alasan_menolak;
    $pkl->save();

    return response()->json([
      'message' => 'Berhasil menolak laporan',
    ], 200);
  }

  public function update_tabel_laporan(){
    $data_mhs = PKL::whereRaw("pkl.status = 'Laporan'")->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')->get();

    $view = view('koordinator.pkl.verifikasi_laporan.update_tabel_laporan', [
      'data_mhs' => $data_mhs
    ])->render();

    return response()->json([
      'view' => $view
    ]);
  }

  // Assign Nilai
  public function index_assign_nilai()
  {
    $data_mhs = PKL::whereRaw("pkl.status = 'Selesai'")->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')->get();

    return view('koordinator.pkl.assign_nilai.index', [
      'data_mhs' => $data_mhs
    ]);
  }

  public function assign_nilai(PKL $pkl, Request $request)
  {
    Mahasiswa::where('nim', $pkl->nim)->update([
      'status' => 'Lulus',
    ]);

    ArsipPKL::create([
      'nim' => $pkl->nim,
      'nama' => $pkl->mahasiswa->nama,
      'instansi' => $pkl->instansi,
      'judul' => $pkl->judul,
      'abstrak' => $pkl->abstrak,
      'keyword1' => $pkl->keyword1,
      'keyword2' => $pkl->keyword2,
      'keyword3' => $pkl->keyword3,
      'keyword4' => $pkl->keyword4,
      'keyword5' => $pkl->keyword5,
      'link_laporan' => $pkl->link_laporan,
      'tgl_verif_laporan' => $pkl->tgl_verif_laporan,
      'nilai' => $request->nilai,
      'periode_pkl' => $pkl->mahasiswa->periode_pkl,
    ]);

    RiwayatPKL::create([
      'nim' => $pkl->nim,
      'periode_pkl' => $pkl->mahasiswa->periode_pkl,
      'status' => 'Lulus',
      'id_dospem' => $pkl->mahasiswa->id_dospem,
      'nilai' => $request->nilai,
    ]);

    if ($pkl->scan_irs != null){
      Storage::delete($pkl->scan_irs);
    }
    
    $pkl->delete();

    $seminar_pkl = SeminarPKL::where('nim', $pkl->nim)->first();

    if ($seminar_pkl){
      if ($seminar_pkl->scan_layak_seminar != null){
        Storage::delete($seminar_pkl->scan_layak_seminar);
      }
      if($seminar_pkl->scan_peminjaman_ruang != null){
        Storage::delete($seminar_pkl->scan_peminjaman_ruang);
      }
      $seminar_pkl->delete();
    }

    return response()->json([
      'message' => 'Berhasil menyimpan nilai',
    ], 200);
  }

  public function update_tabel_nilai(){
    $data_mhs = PKL::whereRaw("pkl.status = 'Selesai'")->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')->get();

    $view = view('koordinator.pkl.assign_nilai.update_tabel_nilai', [
      'data_mhs' => $data_mhs
    ])->render();

    return response()->json([
      'view' => $view
    ]);
  }

}