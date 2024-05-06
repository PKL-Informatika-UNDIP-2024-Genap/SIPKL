<?php

namespace App\Http\Controllers;

// use App\Exports\ArsipPKLExport;
use App\Http\Controllers\Controller;
use App\Models\ArsipPKL;
use App\Http\Requests\StoreArsipPKLRequest;
use App\Http\Requests\UpdateArsipPKLRequest;
use App\Models\PeriodePKL;

class ArsipPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->is_admin == 1) {
            $arr_periode = PeriodePKL::get_arr_id_periode();
    
            $arr_arsip = ArsipPKL::all();
            return view('koordinator.arsip_pkl.index', [
                'arr_arsip' => $arr_arsip,
                'arr_periode' => $arr_periode,
            ]);
            
        } else {
            $user = auth()->user();
            $mahasiswa = $user->mahasiswa;
            $arsip_pkl = $mahasiswa->arsip_pkl;
            if ($arsip_pkl == null) {
                return view('mahasiswa.arsip_pkl.index__nodata', [
                    'user' => $user,
                    'mahasiswa' => $mahasiswa,
                ]);
            } else {
                if ($arsip_pkl->link_laporan != null && $arsip_pkl->link_laporan.substr(0, 7) != 'http://' && $arsip_pkl->link_laporan.substr(0, 8) != 'https://' && $arsip_pkl->link_laporan.substr(0, 2) != '//') {
                    $arsip_pkl->link_laporan = 'https://'.$arsip_pkl->link_laporan;
                }
                return view('mahasiswa.arsip_pkl.index', [
                    'user' => $user,
                    'mahasiswa' => $mahasiswa,
                    'arsip_pkl' => $arsip_pkl,
                ]);
            }
        }
    }

    // public function update_tabel_arsip(){
    //     if(request()->periode_pkl == ""){
    //         $arr_arsip = ArsipPKL::whereIn('periode_pkl', request()->arr_periode)->get();
    //     } else {
    //         $arr_arsip = ArsipPKL::where('periode_pkl', request()->periode_pkl)->get();
    //     }

    //     $view = view('koordinator.arsip_pkl.tabel_arsip', [
    //         'arr_arsip' => $arr_arsip,
    //     ])->render();

    //     return response()->json(['html' => $view]);
    // }
    
    // public function export_arsip_pkl(){
    //     // Proses data yang diterima dari JavaScript
    //     $arr_arsip = request()->arr_arsip;

    //     // Ekspor data ke Excel
    //     $export = Excel::download(new ArsipPKLExport($arr_arsip), 'arsip_pkl.xlsx');

    //     // Mengembalikan file Excel sebagai respons langsung
    //     return $export;
    // }
}
