<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\DosenPembimbing;
use Illuminate\Http\Request;

class AssignDospemController extends Controller
{
    public function index(){
        $data_mhs = Mahasiswa::get_mhs_with_pkl_dospem();

        $data_dospem = DosenPembimbing::select('id', 'nama')->get();

        return view('koordinator.mhs.assign_dospem.index', [
            'data_mhs' => $data_mhs,
            'data_dospem' => $data_dospem,
        ]);
    }

    public function update_dospem($nim, Request $request){
        $validated_data = $request->validate([
            'id_dospem' => 'required',
        ]);

        Mahasiswa::set_dospem($nim, $validated_data['id_dospem']);

        return response()->json([
            'message' => 'Data berhasil diupdate',
        ]);
    }
}
