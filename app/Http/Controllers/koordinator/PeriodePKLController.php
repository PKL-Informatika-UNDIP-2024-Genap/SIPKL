<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\PeriodePKL;
use App\Http\Requests\StorePeriodePKLRequest;
use App\Http\Requests\UpdatePeriodePKLRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PeriodePKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koordinator.pkl.kelola_periode.index', [
            'data_periode' => PeriodePKL::orderBy('tgl_mulai', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_periode' => 'required|unique:periode_pkl',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
        ],
        [
            'id_periode.required' => 'ID Periode tidak boleh kosong',
            'id_periode.unique' => 'ID Periode sudah terdaftar',
            'tgl_mulai.required' => 'Tanggal mulai tidak boleh kosong',
            'tgl_mulai.date' => 'Tanggal mulai harus berupa tanggal',
            'tgl_selesai.required' => 'Tanggal selesai tidak boleh kosong',
            'tgl_selesai.date' => 'Tanggal selesai harus berupa tanggal',
            'tgl_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai',
        ]);

        PeriodePKL::create($validated);

        return response()->json([
            'message' => 'Periode PKL berhasil ditambahkan',
        ]);
    }
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id_periode' => ['required', Rule::unique('periode_pkl')->ignore($request->id_periode, 'id_periode')],
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
        ],
        [
            'id_periode.required' => 'ID Periode tidak boleh kosong',
            'id_periode.unique' => 'ID Periode sudah terdaftar',
            'tgl_mulai.required' => 'Tanggal mulai tidak boleh kosong',
            'tgl_mulai.date' => 'Tanggal mulai harus berupa tanggal',
            'tgl_selesai.required' => 'Tanggal selesai tidak boleh kosong',
            'tgl_selesai.date' => 'Tanggal selesai harus berupa tanggal',
            'tgl_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai',
        ]);

        PeriodePKL::where('id_periode', $request->old_id_periode)->update([
            'id_periode' => $request->id_periode,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
        ]);

        return response()->json([
            'message' => $request->old_id_periode,
        ]);
    }

    public function destroy(Request $request){
        PeriodePKL::where('id_periode', $request->id_periode)->delete();

        return response()->json([
            'message' => 'Periode PKL berhasil dihapus',
        ]);
    }

    public function update_tabel_periode(){
        $data_periode = PeriodePKL::orderBy('tgl_mulai', 'desc')->get();

        $view = view('koordinator.pkl.kelola_periode.update_tabel_periode', [
            'data_periode' => $data_periode,
        ])->render();

        return response()->json([
            'status' => 200,
            'view' => $view,
            'latest_periode' =>  json_encode($data_periode[0]),
        ]);
    }
}
