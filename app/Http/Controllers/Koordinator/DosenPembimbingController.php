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
        return view('koordinator.dospem.kelola_dospem.index', [
            'dospem' => DosenPembimbing::all()
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
            'id' => ['required', Rule::unique('dosen_pembimbing')->ignore($request->id, 'id')],
            'nama' => 'required',
            'nip' => ['required', Rule::unique('dosen_pembimbing')->ignore($request->nip, 'nip')],
            'golongan' => 'required',
            'jabatan' => 'required',
        ],
        [
            'id.required' => 'ID tidak boleh kosong',
            'id.unique' => 'ID sudah terdaftar',
            'nama.required' => 'Nama tidak boleh kosong',
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP sudah terdaftar',
            'golongan.required' => 'Golongan tidak boleh kosong',
            'jabatan.required' => 'Jabatan tidak boleh kosong',
        ]);

        DosenPembimbing::find($request->id)->update($validatedData);

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

    public function update_tabel_dospem()
    {
        $dospem = DosenPembimbing::all();
        $view = view('koordinator.dospem.kelola_dospem.update_tabel_dospem', [
            'dospem' => $dospem
        ])->render();

        return response()->json([
            'status' => 200,
            'view' => $view,
        ]);
    }
}
