<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use App\Http\Requests\StorePKLRequest;
use App\Http\Requests\UpdatePKLRequest;
use App\Models\PeriodePKL;

class PKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.pkl.index', [
            'mahasiswa' => auth()->user()->mahasiswa,
            'pkl' => auth()->user()->mahasiswa->pkl,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePKLRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PKL $pKL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PKL $pKL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePKLRequest $request, PKL $pKL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PKL $pKL)
    {
        //
    }

    public function registrasi()
    {
        if (auth()->user()->mahasiswa->pkl->scan_irs != null) {
            return redirect('/pkl');
        }
        $periode_sekarang = PeriodePKL::where('tgl_selesai', '>=', date('Y-m-d'))->where('tgl_mulai', '<', date('Y-m-d'))->orderBy('tgl_mulai', 'desc')->first();
        return view('mahasiswa.registrasi_pkl', [
            'periode_sekarang' => $periode_sekarang->id_periode,
            'mahasiswa' => auth()->user()->mahasiswa,
            'pkl' => auth()->user()->mahasiswa->pkl,
        ]);
    }

    public function submitRegistrasi(UpdatePKLRequest $request)
    {
        $pkl = auth()->user()->mahasiswa->pkl;
        $validatedData = $request->validate([
            'periode' => 'required',
            'instansi' => 'required',
            'judul' => 'required',
            'scan_irs' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'checkbox1' => 'required',
        ]);
        $validatedData['scan_irs'] = $request->file('scan_irs')->storeAs('private/scan_irs', $pkl->nim . '.' . $request->file('scan_irs')->extension());

        $pkl->update([
            'instansi' => $validatedData['instansi'],
            'judul' => $validatedData['judul'],
            'scan_irs' => $validatedData['scan_irs'],
        ]);
        auth()->user()->mahasiswa->update([
            'periode_pkl' => $validatedData['periode'],
        ]);
        return redirect()->route('pkl.index')->with('success', 'Berhasil mengubah data PKL');
    }
}
