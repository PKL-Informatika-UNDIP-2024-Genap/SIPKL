<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\DosenPembimbing;
use App\Http\Requests\StoreDosenPembimbingRequest;
use App\Http\Requests\UpdateDosenPembimbingRequest;
use Illuminate\Http\Request;

class DosenPembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koordinator.dosbing.kelola_dosbing', [
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
            'nip' => 'required|unique:dosen_pembimbing',
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

        DosenPembimbing::create($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(DosenPembimbing $dosenPembimbing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DosenPembimbing $dosenPembimbing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDosenPembimbingRequest $request, DosenPembimbing $dosenPembimbing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DosenPembimbing $dosenPembimbing)
    {
        //
    }
}
