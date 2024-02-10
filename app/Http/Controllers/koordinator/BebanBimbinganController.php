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
        $arr_periode = PeriodePKL::whereDate('tgl_mulai', '>=', Carbon::now()->subYears(2))
        ->orderByDesc('id_periode')
        ->pluck('id_periode')
        ->toArray();

        $arr_dospem = DosenPembimbing::whereIn('periode_pkl', $arr_periode)
        ->orWhereNull('periode_pkl')
        ->leftJoin('mahasiswa', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
        ->groupBy('dosen_pembimbing.id', 'dosen_pembimbing.nip', 'dosen_pembimbing.nama')
        ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, count(mahasiswa.id_dospem) as jml_bimbingan')
        ->get();

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
            ->groupBy('dosen_pembimbing.id', 'dosen_pembimbing.nip', 'dosen_pembimbing.nama')
            ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, count(mahasiswa.id_dospem) as jml_bimbingan')
            ->get();
        }else if($request->periode_pkl == "belum"){
            $arr_dospem = DosenPembimbing::leftJoin('mahasiswa', function($join) use ($request) {
                $join->on('dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
                     ->whereNull('mahasiswa.periode_pkl');
            })
            ->groupBy('dosen_pembimbing.id', 'dosen_pembimbing.nip', 'dosen_pembimbing.nama')
            ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, COUNT(mahasiswa.id_dospem) as jml_bimbingan')
            ->get();
        } else {
            $arr_dospem = DosenPembimbing::leftJoin('mahasiswa', function($join) use ($request) {
                $join->on('dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
                     ->where('mahasiswa.periode_pkl', '=', $request->periode_pkl);
            })
            ->groupBy('dosen_pembimbing.id', 'dosen_pembimbing.nip', 'dosen_pembimbing.nama')
            ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, COUNT(mahasiswa.id_dospem) as jml_bimbingan')
            ->get();
        }

        $view = view('koordinator.dospem.beban_bimbingan.tabel_update_index', [
            'arr_dospem' => $arr_dospem,
        ])->render();

        return response()->json(['html' => $view]);
    }

    public function get_bimbingan(Request $request){
        $id_dospem = $request->id_dospem;
        $periode_pkl = $request->periode_pkl;

        if($periode_pkl == ''){
            $arr_mhs = Mahasiswa::whereRaw("id_dospem = $id_dospem")->with(['pkl'])->get();
        }else if($periode_pkl == "belum"){
            $arr_mhs = Mahasiswa::whereRaw("id_dospem = $id_dospem AND periode_pkl IS NULL")->with(['pkl'])->get();
        } else {
            $arr_mhs = Mahasiswa::whereRaw("id_dospem = $id_dospem AND periode_pkl = '$periode_pkl'")->with(['pkl'])->get();
        }

        $view = view('koordinator.dospem.beban_bimbingan.tabel_modal', [
            'arr_mhs' => $arr_mhs,
        ])->render();

        return response()->json(['html' => $view]);
    }
}
