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
        $data_sk = CetakSK::get_data_cetak_sk();
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
        $data_sk = CetakSK::get_data_riwayat_cetak_sk();
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

    public function export_riwayat(Request $request)
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
