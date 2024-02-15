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
    $data_dospem = DosenPembimbing::leftJoin('mahasiswa', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
    ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, 
                 COUNT(CASE WHEN mahasiswa.status = "Aktif" OR mahasiswa.status = "Nonaktif" THEN mahasiswa.id_dospem ELSE NULL END) as jumlah_bimbingan')
    ->groupBy('dosen_pembimbing.id','dosen_pembimbing.nip', 'dosen_pembimbing.nama')
    ->get();

    return view('koordinator.dospem.assign_mhs_bimbingan.index',
      [
        'data_dospem' => $data_dospem,
      ]
    );
  }

  public function get_data_mhs($id_dospem)
  {
    $data_mhs = Mahasiswa::whereRaw("(id_dospem = '$id_dospem' OR id_dospem IS NULL) AND (mahasiswa.status = 'Aktif' OR mahasiswa.status = 'Nonaktif')")
    ->join('pkl', 'mahasiswa.nim', '=', 'pkl.nim')
    ->select('mahasiswa.*', 'pkl.instansi', 'pkl.judul')
    ->get();

    $view = view('koordinator.dospem.assign_mhs_bimbingan.tabel_mhs_modal', [
      'data_mhs' => $data_mhs,
    ])->render();

    return response()->json([
      'status' => 200,
      'view' => $view,
    ]);
  }

  public function update_mhs_bimbingan($id_dospem, Request $request){
    if (!empty($request->arr_nim_add_mhs)) {
      Mahasiswa::whereIn('nim', $request->arr_nim_add_mhs)->update(['id_dospem' => $id_dospem]);
    }

    if (!empty($request->arr_nim_delete_mhs)) {
        Mahasiswa::whereIn('nim', $request->arr_nim_delete_mhs)->update(['id_dospem' => null]);
    }

    return response()->json([
      'status' => 200,
    ]);
  }

  public function update_tabel_dospem(){
    $data_dospem = DosenPembimbing::leftJoin('mahasiswa', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
    ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, 
                 COUNT(CASE WHEN mahasiswa.status = "Aktif" OR mahasiswa.status = "Nonaktif" THEN mahasiswa.id_dospem ELSE NULL END) as jumlah_bimbingan')
    ->groupBy('dosen_pembimbing.id','dosen_pembimbing.nip', 'dosen_pembimbing.nama')
    ->get();

    $view = view('koordinator.dospem.assign_mhs_bimbingan.update_tabel_dospem', [
      'data_dospem' => $data_dospem,
    ])->render();

    return response()->json([
      'status' => 200,
      'view' => $view,
    ]);
  }

}
