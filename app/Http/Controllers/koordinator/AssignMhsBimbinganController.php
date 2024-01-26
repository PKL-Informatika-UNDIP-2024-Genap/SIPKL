<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DosenPembimbing;
use App\Models\Mahasiswa;
use App\Models\PKL;

class AssignMhsBimbinganController extends Controller
{
  public function index()
  {
    $data_dospem = DosenPembimbing::leftJoin('mahasiswa', 'dosen_pembimbing.nip', '=', 'mahasiswa.nip_dospem')
      ->selectRaw('dosen_pembimbing.nip, dosen_pembimbing.nama, count(mahasiswa.nip_dospem) as jumlah_bimbingan')
      ->whereRaw("mahasiswa.status = 'Nonaktif' OR mahasiswa.status = 'Aktif' OR mahasiswa.status IS NULL")
      ->groupBy('dosen_pembimbing.nip', 'dosen_pembimbing.nama')
      ->get();

    return view('koordinator.dospem.assign_mhs_bimbingan.index',
      [
        'data_dospem' => $data_dospem,
      ]
    );
  }

  public function get_data_mhs($nip)
  {
    $data_mhs = Mahasiswa::whereRaw("nip_dospem = '$nip' OR (nip_dospem IS NULL AND (status = 'Aktif' OR status = 'Nonaktif'))")->get();

    $view = view('koordinator.dospem.assign_mhs_bimbingan.tabel_mhs_modal', [
      'data_mhs' => $data_mhs,
    ])->render();

    return response()->json([
      'status' => 200,
      'view' => $view,
    ]);
  }

  public function get_data_pkl($nim)
  {
      $data_pkl = PKL::select('instansi', 'judul')->where('nim', $nim)->first();

      $judul_pkl = $data_pkl ? $data_pkl->judul : "-";
      $instansi_pkl = $data_pkl ? $data_pkl->instansi : "-";

      return response()->json([
          'status' => 200,
          'judul_pkl' => $judul_pkl,
          'instansi_pkl' => $instansi_pkl,
          'nim' => $nim,
      ]);
  }

}
