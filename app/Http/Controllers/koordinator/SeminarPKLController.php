<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\SeminarPKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SeminarPKLController extends Controller
{
  public function index_verif_pengajuan()
  {
    $data_pengajuan = SeminarPKL::whereRaw('status = "Pengajuan" AND pesan is NULL')->with(["mahasiswa", "dosen_pembimbing"])->get();

    return view('koordinator.seminar.verifikasi_pengajuan.index', [
      'data_pengajuan' => $data_pengajuan
    ]);
  }

  public function terima_pengajuan(SeminarPKL $seminar_pkl){
    $seminar_pkl->update([
      'status' => 'Tak Terjadwal'
    ]);

    return response()->json([
      'message' => 'Pengajuan Seminar PKL telah diterima'
    ]);
  }

  public function tolak_pengajuan(SeminarPKL $seminar_pkl){
    $seminar_pkl->update([
      'status' => 'Pengajuan',
      'pesan' => request('alasan_menolak'),
    ]);

    return response()->json([
      'message' => 'Pengajuan Seminar PKL telah ditolak'
    ]);
  }

  public function update_tabel_pengajuan(){
    $data_pengajuan = SeminarPKL::whereRaw('status = "Pengajuan" AND pesan is NULL')->with(["mahasiswa", "dosen_pembimbing"])->get();

    $view = view('koordinator.seminar.verifikasi_pengajuan.update_tabel_pengajuan', [
      'data_pengajuan' => $data_pengajuan
    ])->render();

    return response()->json([
      'view' => $view
    ]);
  }


  // Jadwal Seminar
  public function index_jadwal_seminar()
  {
    $data_jadwal = SeminarPKL::whereRaw('status = "Tak Terjadwal" OR status = "Terjadwal"')->with(["mahasiswa", "dosen_pembimbing"])->get();

    return view('koordinator.seminar.jadwal_seminar.index', [
      'data_jadwal' => $data_jadwal
    ]);
  }

  public function tambah_jadwal_seminar(Request $request){
    $arr_mhs = $request->arr_mhs;
    $data = [];
    foreach ($arr_mhs as $mhs) {
      $data[] = [
        'nim' => $mhs[0],
        'tgl_seminar' => $request->tgl_seminar,
        'waktu_seminar' => $request->waktu_seminar,
        'ruang' => $request->ruang,
        'status' => 'Terjadwal',
        'id_dospem' => $mhs[1],
      ];
    }

    SeminarPKL::insert($data);

    return response()->json([
      'message' => 'Jadwal Seminar PKL telah ditambahkan'
    ]);
  }

  public function get_mhs_aktif(){
    $mhs_aktif = Mahasiswa::where('status', 'Aktif')
    ->whereNotIn('nim', function($query) {
        $query->select('nim')->from('seminar_pkl');
    })
    ->with(["pkl", "dosen_pembimbing"])
    ->get();

    $view = view('koordinator.seminar.jadwal_seminar.tabel_modal_tambah', [
      'mhs_aktif' => $mhs_aktif
    ])->render();

    return response()->json([
      'view' => $view
    ]);
  }


  public function update_jadwal_seminar(SeminarPKL $seminar_pkl){
    $seminar_pkl->update([
      'tgl_seminar' => request('tgl_seminar'),
      'waktu_seminar' => request('waktu_seminar'),
      'ruang' => request('ruang'),
    ]);

    return response()->json([
      'message' => $seminar_pkl
    ]);
  }

  public function update_tabel_jadwal(){
    $data_jadwal = SeminarPKL::whereRaw('status = "Tak Terjadwal" OR status = "Terjadwal"')->with(["mahasiswa", "dosen_pembimbing"])->get();

    $view = view('koordinator.seminar.jadwal_seminar.update_tabel_jadwal', [
      'data_jadwal' => $data_jadwal
    ])->render();

    return response()->json([
      'view' => $view
    ]);
  }
}