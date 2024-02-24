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
    $data_dospem = DosenPembimbing::count_bimbingan_aktif_per_dospem();

    return view('koordinator.dospem.assign_mhs_bimbingan.index',
      [
        'data_dospem' => $data_dospem,
      ]
    );
  }

  public function get_data_mhs($id_dospem)
  {
    $data_mhs = Mahasiswa::get_mhs_wwo_dospem($id_dospem);

    $view = view('koordinator.dospem.assign_mhs_bimbingan.tabel_mhs_modal', [
      'data_mhs' => $data_mhs,
    ])->render();

    return response()->json([
      'status' => 200,
      'view' => $view,
    ]);
  }

  public function update_mhs_bimbingan($id_dospem, Request $request){
    Mahasiswa::bulk_update_dospem_mhs($id_dospem, $request->arr_nim_add_mhs, $request->arr_nim_delete_mhs);

    return response()->json([
      'status' => 200,
    ]);
  }

  public function update_tabel_dospem(){
    $data_dospem = DosenPembimbing::count_bimbingan_aktif_per_dospem();

    $view = view('koordinator.dospem.assign_mhs_bimbingan.update_tabel_dospem', [
      'data_dospem' => $data_dospem,
    ])->render();

    return response()->json([
      'status' => 200,
      'view' => $view,
    ]);
  }

}
