<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\DosenPembimbing;
use Illuminate\Http\Request;

class AssignDospemController extends Controller
{
    public function index(){
        $data_mhs = Mahasiswa::select('mahasiswa.nim', 'mahasiswa.nama', 'mahasiswa.status', 'mahasiswa.id_dospem', 'dosen_pembimbing.nama as nama_dospem', 'pkl.instansi', 'pkl.judul')
        ->whereRaw("mahasiswa.status = 'Nonaktif' OR mahasiswa.status = 'Aktif'")
        ->leftJoin('dosen_pembimbing', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
        ->leftJoin('pkl', 'pkl.nim', '=', 'mahasiswa.nim')
        ->get();

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

        Mahasiswa::where('nim', $nim)->update([
            'id_dospem' => $validated_data['id_dospem'],
        ]);

        return response()->json([
            'message' => 'Data berhasil diupdate',
        ]);
    }
}
