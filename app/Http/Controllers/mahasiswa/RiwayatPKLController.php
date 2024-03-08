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
            $data_pkl = [
                'periode_pkl' => $mahasiswa->periode_pkl,
                'status' => 'Berjalan',
                'nama_dospem' => '-',
                'nip_dospem' => '-',
            ];
            if ($mahasiswa->id_dospem != null){
                $data_dospem = DosenPembimbing::select('nama', 'nip')->where('id', $mahasiswa->id_dospem)->first();
                $data_pkl['nama_dospem'] = $data_dospem->nama;
                $data_pkl['nip_dospem'] = $data_dospem->nip;
            }
        }
        return view('mahasiswa.riwayat_pkl', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'pkl' => $pkl,
            'data_riwayat_pkl' => $data_riwayat_pkl,
            'data_pkl' => $data_pkl,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiwayatPKLRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatPKL $riwayatPKL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatPKL $riwayatPKL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiwayatPKLRequest $request, RiwayatPKL $riwayatPKL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatPKL $riwayatPKL)
    {
        //
    }
}
