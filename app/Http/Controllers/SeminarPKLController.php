<?php

namespace App\Http\Controllers;

use App\Models\SeminarPKL;
use App\Http\Requests\StoreSeminarPKLRequest;
use App\Http\Requests\UpdateSeminarPKLRequest;

class SeminarPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.seminar.index', [
            'mahasiswa' => auth()->user()->mahasiswa,
            'seminar' => auth()->user()->mahasiswa->seminarPKL,
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
    public function store(StoreSeminarPKLRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SeminarPKL $seminarPKL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeminarPKL $seminarPKL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeminarPKLRequest $request, SeminarPKL $seminarPKL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeminarPKL $seminarPKL)
    {
        //
    }

    /**
     * Daftar seminar Tak Terjadwal.
     */
    public function daftarSeminar(StoreSeminarPKLRequest $request)
    {
        request()->validate([
            'nim' => 'required',
            'nip_dospem' => 'required',
            'tgl_seminar' => 'required|date',
            'waktu_seminar_mulai' => 'required',
            'waktu_seminar_selesai' => 'required',
            'ruang' => 'required',
            'scan_layak_seminar' => 'required|file|mimes:pdf|max:1500',
            'scan_peminjaman_ruang' => 'required|file|mimes:pdf|max:1500',
        ], [
            'required' => ':attribute harus diisi.',
            'date' => ':attribute harus berupa tanggal.',
            'mimes' => ':attribute harus berupa file pdf.',
            'max' => ':attribute maksimal 1.5MB.',
        ], [
            'nim' => 'NIM',
            'nip_dospem' => 'NIP Dosen Pembimbing',
            'tgl_seminar' => 'Tanggal Seminar',
            'waktu_seminar_mulai' => 'Pukul Seminar Awal',
            'waktu_seminar_selesai' => 'Pukul Seminar Akhir',
            'ruang' => 'Ruang Seminar',
            'scan_layak_seminar' => 'Scan Surat Keterangan Layak Seminar',
            'scan_peminjaman_ruang' => 'Scan Surat Peminjaman Ruang',
        ]);

        SeminarPKL::create([
            'nim' => $request->nim,
            'status' => 'Pengajuan',
            'tgl_seminar' => $request->tgl_seminar,
            'waktu_seminar' => $request->waktu_seminar_mulai . '-' . $request->waktu_seminar_selesai,
            'ruang' => $request->ruang,
            'nip_dospem' => $request->nip_dospem,
            'scan_layak_seminar' => $request->file('scan_layak_seminar')->storeAs('private/scan_layak_seminar', $request->nim . '-' . now()->timestamp . '-' . uniqid() . '.' . $request->file('scan_layak_seminar')->extension()),
            'scan_peminjaman_ruang' => $request->file('scan_peminjaman_ruang')->storeAs('private/scan_peminjaman_ruang', $request->nim . '-' . now()->timestamp . '-' . uniqid() . '.' . $request->file('scan_peminjaman_ruang')->extension()),
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar seminar.');
    }
}
