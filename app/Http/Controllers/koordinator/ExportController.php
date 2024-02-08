<?php

namespace App\Http\Controllers\Koordinator;

use App\Models\PKL;
use App\Exports\SKExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        $data_sk = PKL::select('dosen_pembimbing.id as id_dospem' ,'dosen_pembimbing.nama as nama_dospem', 'dosen_pembimbing.nip as nip_dospem', 'dosen_pembimbing.golongan as gol_dospem', 'dosen_pembimbing.jabatan as jabatan_dospem', 'mahasiswa.nama as nama_mhs', 'mahasiswa.nim as nim_mhs', 'pkl.judul as judul_pkl')->whereRaw("pkl.status = 'Selesai' OR pkl.status = 'Laporan'")->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')->join('dosen_pembimbing', 'mahasiswa.id_dospem', '=', 'dosen_pembimbing.id')->get();
        $data_sk = $data_sk->sortBy('nama_dospem');
        $counter = $data_sk->groupBy('id_dospem')->map->count()->values();
        return view('koordinator.cetak_sk.index', [
            'data_sk' => $data_sk,
            'counter' => $counter,
        ]);
    }

    /**
     * Export to excel
     */
    public function export()
    {
        // return Excel::download(new SKExport, 'SK PKL.xlsx');
        return (new SKExport)->download('SK PKL.xlsx');
    }
}
