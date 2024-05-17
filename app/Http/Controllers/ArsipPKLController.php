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
                if ($arsip_pkl->link_berkas != null && $arsip_pkl->link_berkas.substr(0, 7) != 'http://' && $arsip_pkl->link_berkas.substr(0, 8) != 'https://' && $arsip_pkl->link_berkas.substr(0, 2) != '//') {
                    $arsip_pkl->link_berkas = 'https://'.$arsip_pkl->link_berkas;
                }
                return view('mahasiswa.arsip_pkl.index', [
                    'user' => $user,
                    'mahasiswa' => $mahasiswa,
                    'arsip_pkl' => $arsip_pkl,
                ]);
            }
        }
    }

}
