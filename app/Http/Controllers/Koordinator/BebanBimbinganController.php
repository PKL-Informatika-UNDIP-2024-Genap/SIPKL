<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\DosenPembimbing;
use App\Models\Mahasiswa;
use App\Models\PeriodePKL;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BebanBimbinganController extends Controller
{
    public function index()
    {
        $arr_periode = PeriodePKL::get_arr_recent_periode();

        $arr_dospem = DosenPembimbing::count_bimbingan_per_dospem('', $arr_periode);

        return view('koordinator.dospem.beban_bimbingan.index', [
            'arr_dospem' => $arr_dospem,
            'arr_periode' => $arr_periode,
        ]);
    }

    public function update_tabel_index(Request $request){
        $arr_periode = $request->arr_periode;
        $periode_pkl = $request->periode_pkl;

        $arr_dospem = DosenPembimbing::count_bimbingan_per_dospem($periode_pkl, $arr_periode);

        $view = view('koordinator.dospem.beban_bimbingan.tabel_update_index', [
            'arr_dospem' => $arr_dospem,
        ])->render();

        return response()->json(['html' => $view]);
    }

    public function get_bimbingan(Request $request){
        $id_dospem = $request->id_dospem;
        $periode_pkl = $request->periode_pkl;

        $arr_mhs = Mahasiswa::get_mhs_by_dospem_periode($id_dospem, $periode_pkl);

        $view = view('koordinator.dospem.beban_bimbingan.tabel_modal', [
            'arr_mhs' => $arr_mhs,
        ])->render();

        return response()->json(['html' => $view]);
    }
}
