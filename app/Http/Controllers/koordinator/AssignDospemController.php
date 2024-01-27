<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\DosenPembimbing;
use Illuminate\Http\Request;

class AssignDospemController extends Controller
{
    public function index(){
        $data_mhs = Mahasiswa::select('mahasiswa.nim', 'mahasiswa.nama', 'mahasiswa.status', 'mahasiswa.nip_dospem', 'dosen_pembimbing.nama as nama_dospem')
        ->whereRaw("status = 'Nonaktif' OR status = 'Aktif'")
        ->leftJoin('dosen_pembimbing', 'dosen_pembimbing.nip', '=', 'mahasiswa.nip_dospem')->get();

        $data_dospem = DosenPembimbing::select('nip', 'nama')->get();

        return view('koordinator.mhs.assign_dospem.index', [
            'data_mhs' => $data_mhs,
            'data_dospem' => $data_dospem,
        ]);
    }

    public function update_dospem($nim, Request $request){
        $validated_data = $request->validate([
            'nip_dospem' => 'required',
        ]);

        Mahasiswa::where('nim', $nim)->update([
            'nip_dospem' => $validated_data['nip_dospem'],
        ]);

        return response()->json([
            'message' => 'Data berhasil diupdate',
        ]);
    }
}
