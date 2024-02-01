<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\PKL;
use App\Models\PeriodePKL;
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

  public function assign_nilai(PKL $pkl)
  {
    $pkl->status = 'Lulus';
    $pkl->pesan = null;
    $pkl->save();

    Mahasiswa::where('nim', $pkl->nim)->update([
      'status' => 'Lulus',
    ]);

    return response()->json([
      'message' => 'Berhasil menerima nilai',
    ], 200);
  }

}