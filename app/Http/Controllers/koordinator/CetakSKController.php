<?php

namespace App\Http\Controllers\Koordinator;

use Carbon\Carbon;
use App\Models\CetakSK;
use App\Exports\SKExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreCetakSKRequest;
use App\Http\Requests\UpdateCetakSKRequest;

class CetakSKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_sk = CetakSK::select('dosen_pembimbing.id as id_dospem' ,'dosen_pembimbing.nama as nama_dospem', 'dosen_pembimbing.nip as nip_dospem', 'dosen_pembimbing.golongan as gol_dospem', 'dosen_pembimbing.jabatan as jabatan_dospem', 'cetak_sk.nama as nama_mhs', 'cetak_sk.nim as nim_mhs', 'judul as judul_pkl', 'tgl_verif_laporan')->join('dosen_pembimbing', 'cetak_sk.id_dospem', '=', 'dosen_pembimbing.id')->where('status', 'Belum')->get();
        $data_sk = $data_sk->sortBy('nama_dospem');
        $counter = $data_sk->groupBy('id_dospem')->map->count()->values();
        return view('koordinator.cetak_sk.index', [
            'data_sk' => $data_sk,
            'counter' => $counter,
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
    public function store(StoreCetakSKRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CetakSK $cetakSK)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CetakSK $cetakSK)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCetakSKRequest $request, CetakSK $cetakSK)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CetakSK $cetakSK)
    {
        //
    }

    /**
     * Export to excel
     */
    public function export(Request $request)
    {
        $request->validate(
            [
                'tgl_mulai' => [
                    'required',
                    'date', 
                    function ($attribute, $value, $fail) {
                        $latestTglSelesai = CetakSK::max('tgl_selesai');
                        if ($latestTglSelesai) {
                            if ($value <= $latestTglSelesai) {
                                $fail('Tanggal mulai tidak boleh overlap dengan tanggal selesai sebelumnya. Tanggal selesai terakhir: '.Carbon::parse($latestTglSelesai)->isoFormat('D/MM/Y'));
                            }
                        }
                    }
                ],
                'tgl_selesai' => 'required|date|after:tgl_mulai',
            ],
            [
                'required' => ':attribute harus diisi',
                'date' => ':attribute harus berupa tanggal',
                'after' => ':attribute harus setelah tanggal mulai',
            ],
            [
                'tgl_mulai' => 'Tanggal Mulai',
                'tgl_selesai' => 'Tanggal Selesai',
            ]
        );
        Session::flash('download', 'Mendownload file.');
        // return Excel::download(new SKExport(), 'SK PKL.xlsx');
        return (new SKExport("Belum", $request->tgl_mulai, $request->tgl_selesai))->download('SK PKL Periode '.Carbon::parse($request->tgl_mulai)->isoFormat('D MMMM Y').' - '.Carbon::parse($request->tgl_selesai)->isoFormat('D MMMM Y').'.xlsx');
    }

    public function riwayat()
    {
        $data_sk = CetakSK::select('dosen_pembimbing.id as id_dospem' ,'dosen_pembimbing.nama as nama_dospem', 'dosen_pembimbing.nip as nip_dospem', 'dosen_pembimbing.golongan as gol_dospem', 'dosen_pembimbing.jabatan as jabatan_dospem', 'cetak_sk.nama as nama_mhs', 'cetak_sk.nim as nim_mhs', 'judul as judul_pkl', 'tgl_mulai', 'tgl_selesai')->join('dosen_pembimbing', 'cetak_sk.id_dospem', '=', 'dosen_pembimbing.id')->where('status', 'Sudah')->get();
        $periode_sk = $data_sk->map(function ($item) {
            return [$item->tgl_mulai, $item->tgl_selesai];
        })->unique()->sortByDesc(0)->values()->all();
        $data_sk = $data_sk->sortBy('nama_dospem');
        $counter = $data_sk->groupBy('id_dospem')->map->count()->values();

        return view('koordinator.cetak_sk.riwayat', [
            'periode_sk' => $periode_sk,
            'data_sk' => $data_sk,
            'counter' => $counter,
        ]);
    }

    public function exportRiwayat(Request $request)
    {
        $request->validate(
            [
                'periode_sk' => 'required|date',
            ],
            [
                'required' => ':attribute harus diisi',
                'date' => ':attribute harus berupa tanggal',
            ],
            [
                'periode_sk' => 'Periode SK',
            ]
        );
        $periode_sk_selesai = CetakSK::where('tgl_mulai', $request->periode_sk)->value('tgl_selesai');
        return (new SKExport("Sudah", $request->periode_sk, $periode_sk_selesai))->download('SK PKL Periode '.Carbon::parse($request->periode_sk)->isoFormat('D MMMM Y').' - '.Carbon::parse($periode_sk_selesai)->isoFormat('D MMMM Y').'.xlsx');
    }
}
