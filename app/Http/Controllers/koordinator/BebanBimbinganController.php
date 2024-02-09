<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\DosenPembimbing;
use App\Models\PeriodePKL;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BebanBimbinganController extends Controller
{
    public function index()
    {
        $arr_periode = PeriodePKL::whereDate('tgl_mulai', '>=', Carbon::now()->subYears(2))
        ->orderByDesc('id_periode')
        ->pluck('id_periode')
        ->toArray();

        $arr_dospem = DosenPembimbing::whereIn('periode_pkl', $arr_periode)
        ->orWhereNull('periode_pkl')
        ->leftJoin('mahasiswa', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
        ->groupBy('dosen_pembimbing.nip', 'dosen_pembimbing.nama')
        ->selectRaw('dosen_pembimbing.nip, dosen_pembimbing.nama, count(mahasiswa.id_dospem) as jml_bimbingan')
        ->get();

        // dd($arr_dospem, $arr_periode);

        return view('koordinator.dospem.beban_bimbingan.index', [
            'arr_dospem' => $arr_dospem,
            'arr_periode' => $arr_periode,
        ]);
    }

    public function update_tabel_index(Request $request){
        $arr_periode = $request->arr_periode;

        if($request->periode_pkl == ''){
            $arr_dospem = DosenPembimbing::whereIn('periode_pkl', $arr_periode)
            ->orWhereNull('periode_pkl')
            ->leftJoin('mahasiswa', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
            ->groupBy('dosen_pembimbing.nip', 'dosen_pembimbing.nama')
            ->selectRaw('dosen_pembimbing.nip, dosen_pembimbing.nama, count(mahasiswa.id_dospem) as jml_bimbingan')
            ->get();
        }else if($request->periode_pkl == $arr_periode[0]){
            $arr_dospem = DosenPembimbing::where('periode_pkl', $arr_periode[0])
            ->orWhereNull('periode_pkl')
            ->leftJoin('mahasiswa', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
            ->groupBy('dosen_pembimbing.nip', 'dosen_pembimbing.nama')
            ->selectRaw('dosen_pembimbing.nip, dosen_pembimbing.nama, count(mahasiswa.id_dospem) as jml_bimbingan')
            ->get();
        } else {
            $arr_dospem = DosenPembimbing::leftJoin('mahasiswa', function($join) use ($request) {
                $join->on('dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
                     ->where('mahasiswa.periode_pkl', '=', $request->periode_pkl);
            })
            ->groupBy('dosen_pembimbing.nip', 'dosen_pembimbing.nama')
            ->selectRaw('dosen_pembimbing.nip, dosen_pembimbing.nama, COUNT(mahasiswa.id_dospem) as jml_bimbingan')
            ->get();
        }

        $view = view('koordinator.dospem.beban_bimbingan.tabel_update_index', [
            'arr_dospem' => $arr_dospem,
        ])->render();

        return response()->json(['html' => $view]);
    }
}
