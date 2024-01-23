<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\DosenPembimbing;
use App\Http\Requests\StoreDosenPembimbingRequest;
use App\Http\Requests\UpdateDosenPembimbingRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DosenPembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koordinator.dosbing.kelola_dosbing.index', [
            'dosbing' => DosenPembimbing::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:dosen_pembimbing|max:25',
            'golongan' => 'required',
            'jabatan' => 'required',
        ],
        [
            'nama.required' => 'Nama tidak boleh kosong',
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP sudah terdaftar',
            'nip.max' => 'NIP maksimal 25 karakter',
            'golongan.required' => 'Golongan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
        ]);

        DosenPembimbing::create($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nip' => ['required', Rule::unique('dosen_pembimbing')->ignore($request->nip, 'nip')],
            'golongan' => 'required',
            'jabatan' => 'required',
        ],
        [
            'nama.required' => 'Nama tidak boleh kosong',
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP sudah terdaftar',
            'golongan.required' => 'Golongan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
        ]);

        DosenPembimbing::where('nip', $request->nip)->update($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DosenPembimbing $dosenPembimbing)
    {
        $dosenPembimbing->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function update_tabel_dosbing()
    {
        $dosbing = DosenPembimbing::all();
        $view = view('koordinator.dosbing.kelola_dosbing.update_tabel_dosbing', [
            'dosbing' => $dosbing
        ])->render();

        return response()->json([
            'status' => 200,
            'view' => $view,
        ]);
    }

    public function bebang_bimbingan()
    {
        
    }
}
