<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\PKL;
use App\Models\PeriodePKL;
use Illuminate\Http\Request;

class PKLController extends Controller
{
  // Verifikasi Registrasi
  public function index_verif_reg()
  {
    $data_pkl = PKL::get_data_reg_pkl();

    return view('koordinator.pkl.verifikasi_registrasi.index', [
      'data_pkl' => $data_pkl
    ]);
  }

  public function terima_registrasi(PKL $pkl)
  {
    $periode_pkl = PeriodePKL::get_recent_periode();
    
    if(!$periode_pkl){
      return response()->json([
        'message' => 'Tidak ada periode PKL yang aktif',
      ], 400);
    }

    PKL::terima_registrasi($pkl, $periode_pkl);

    return response()->json([
      'message' => 'Berhasil menerima registrasi',
    ], 200);
  }

  public function tolak_registrasi(PKL $pkl, Request $request)
  {
    PKL::tolak_registrasi($pkl, $request->alasan_menolak);

    return response()->json([
      'message' => 'Berhasil menolak registrasi',
    ], 200);
  }

  public function update_tabel_registrasi(){
    $data_pkl = PKL::get_data_reg_pkl();

    $view = view('koordinator.pkl.verifikasi_registrasi.update_tabel_registrasi', [
      'data_pkl' => $data_pkl
    ])->render();

    return response()->json([
      'view' => $view
    ]);
  }


  // Verifikasi Laporan
  public function index_verif_laporan()
  {
    $data_mhs = PKL::get_data_laporan_pkl();

    return view('koordinator.pkl.verifikasi_laporan.index', [
      'data_mhs' => $data_mhs
    ]);
  }

  public function terima_laporan(PKL $pkl)
  {
    PKL::terima_laporan($pkl);

    return response()->json([
      'message' => 'Berhasil menerima laporan',
    ], 200);
  }

  public function tolak_laporan(PKL $pkl, Request $request)
  {
    PKL::tolak_laporan($pkl, $request->alasan_menolak);

    return response()->json([
      'message' => 'Berhasil menolak laporan',
    ], 200);
  }

  public function update_tabel_laporan(){
    $data_mhs = PKL::get_data_laporan_pkl();

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
    $data_mhs = PKL::get_data_pkl_selesai();

    return view('koordinator.pkl.assign_nilai.index', [
      'data_mhs' => $data_mhs
    ]);
  }

  public function assign_nilai(PKL $pkl, Request $request)
  {
    PKL::assign_nilai($pkl, $request->nilai_angka);

    return response()->json([
      'message' => 'Berhasil menyimpan nilai',
    ], 200);
  }

  public function update_tabel_nilai(){
    $data_mhs = PKL::get_data_pkl_selesai();

    $view = view('koordinator.pkl.assign_nilai.update_tabel_nilai', [
      'data_mhs' => $data_mhs
    ])->render();

    return response()->json([
      'view' => $view
    ]);
  }

}