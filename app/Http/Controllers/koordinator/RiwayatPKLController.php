<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\RiwayatPKL;
use App\Http\Requests\StoreRiwayatPKLRequest;
use App\Http\Requests\UpdateRiwayatPKLRequest;
use App\Models\Mahasiswa;

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

        // $user = auth()->user();
        // $mahasiswa = $user->mahasiswa;
        // $pkl = $mahasiswa->pkl;
        // $data_riwayat_pkl = RiwayatPKL::where('nim', $mahasiswa->nim)->get();
        // return view('mahasiswa.riwayat_pkl', [
        //     'user' => $user,
        //     'mahasiswa' => $mahasiswa,
        //     'pkl' => $pkl,
        //     'data_riwayat_pkl' => $data_riwayat_pkl,
        // ]);
    }

    public function getDataRiwayat($nim)
    {
        $data_riwayat_pkl = RiwayatPKL::select('periode_pkl','status','dosen_pembimbing.nama as nama_dospem')->join('dosen_pembimbing', 'dosen_pembimbing.id', '=', 'riwayat_pkl.id_dospem')->where('nim', $nim)->get();
        $view = view('koordinator.riwayat_pkl.tabel_riwayat_modal', [
            'data_riwayat_pkl' => $data_riwayat_pkl,
        ])->render();

        return response()->json([
            'status' => 200,
            'view' => $view,
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
