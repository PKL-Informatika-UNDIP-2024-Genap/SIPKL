<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\PKL;
use App\Models\PeriodePKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PKLController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index_verif_reg()
  {
    $data_mhs = PKL::whereRaw('pkl.status = 0')->join('pkl', 'pkl.nim', '=', 'mahasiswa.nim')->get();

    return view('koordinator.pkl.verifikasi_registrasi.index', [
      
    ]);
  }
}