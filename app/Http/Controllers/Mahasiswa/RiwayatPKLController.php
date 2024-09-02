<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\RiwayatPKL;
use App\Models\DosenPembimbing;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRiwayatPKLRequest;
use App\Http\Requests\UpdateRiwayatPKLRequest;

class RiwayatPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        $pkl = $mahasiswa->pkl;
        $data_riwayat_pkl = RiwayatPKL::where('nim', $mahasiswa->nim)->get();
        $data_pkl = null;
        if ($mahasiswa->status == 'Aktif') {
            if ($mahasiswa->id_dospem != null){
                $data_dospem = DosenPembimbing::get_nama_nip_by_id($mahasiswa->id_dospem);
            }
            $data_pkl = [
                'periode_pkl' => $mahasiswa->periode_pkl,
                'status' => 'Berjalan',
                'nama_dospem' => $data_dospem->nama ?? '-',
                'nip_dospem' => $data_dospem->nip ?? '-',
            ];
        }
        return view('mahasiswa.riwayat_pkl', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'pkl' => $pkl,
            'data_riwayat_pkl' => $data_riwayat_pkl,
            'data_pkl' => $data_pkl,
        ]);
    }

}
