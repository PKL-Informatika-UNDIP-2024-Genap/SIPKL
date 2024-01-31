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
  /**
   * Display a listing of the resource.
   */
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

}