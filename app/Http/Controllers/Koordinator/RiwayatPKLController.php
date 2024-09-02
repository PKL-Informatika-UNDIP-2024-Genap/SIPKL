<?php

namespace App\Http\Controllers\Koordinator;

use App\Models\Mahasiswa;
use App\Models\RiwayatPKL;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRiwayatPKLRequest;
use App\Http\Requests\UpdateRiwayatPKLRequest;
use App\Models\DosenPembimbing;

class RiwayatPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::select('nim','nama','status','id_dospem', 'periode_pkl')->get();

        return view('koordinator.riwayat_pkl.index', [
            'arr_mhs' => $mahasiswa,
        ]);
    }

    public function get_data_riwayat($nim, Request $request)
    {
        $data_riwayat_pkl = RiwayatPKL::select('periode_pkl','status','dosen_pembimbing.nama as nama_dospem', 'dosen_pembimbing.nip as nip_dospem')->join('dosen_pembimbing', 'dosen_pembimbing.id', '=', 'riwayat_pkl.id_dospem')->where('nim', $nim)->get();
        $data_pkl = null;
        if ($request->status == 'Aktif') {
            $data_pkl = [
                'periode_pkl' => $request->periode_pkl,
                'status' => 'Berjalan',
                'nama_dospem' => '-',
                'nip_dospem' => '-',
            ];
            if ($request->id_dospem != '-'){
                $data_dospem = DosenPembimbing::select('nama', 'nip')->where('id', $request->id_dospem)->first();
                $data_pkl['nama_dospem'] = $data_dospem->nama;
                $data_pkl['nip_dospem'] = $data_dospem->nama;
            }
            
        }
        $view = view('koordinator.riwayat_pkl.tabel_riwayat_modal', [
            'data_riwayat_pkl' => $data_riwayat_pkl,
            'data_pkl' => $data_pkl,
        ])->render();

        return response()->json([
            'status' => 200,
            'view' => $view,
        ]);
    }

}
