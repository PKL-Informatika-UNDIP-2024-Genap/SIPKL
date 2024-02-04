<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SeminarPKL;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSeminarPKLRequest;
use App\Http\Requests\UpdateSeminarPKLRequest;

class SeminarPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $seminar_pkl = $mahasiswa->seminar_pkl;
        // setlocale(LC_TIME, 'id_ID');
        // Carbon::setLocale('id');
        $hari_tgl_seminar = null;
        if ($seminar_pkl != null){
            $hari_tgl_seminar =  Carbon::parse($seminar_pkl->tgl_seminar)->isoFormat('dddd, D MMMM Y');
        }
        return view('mahasiswa.seminar.index', [
            'mahasiswa' => $mahasiswa,
            'seminar_pkl' => $seminar_pkl,
            'hari_tgl_seminar' => $hari_tgl_seminar,
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
        $validator = validator($request->all(), [
            'nim' => 'required',
            'id_dospem' => 'required',
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
            'id_dospem' => 'ID Dosen Pembimbing',
            'tgl_seminar' => 'Tanggal Seminar',
            'waktu_seminar_mulai' => 'Waktu Seminar Awal',
            'waktu_seminar_selesai' => 'Waktu Seminar Akhir',
            'ruang' => 'Ruang Seminar',
            'scan_layak_seminar' => 'Scan Surat Keterangan Layak Seminar',
            'scan_peminjaman_ruang' => 'Scan Surat Peminjaman Ruang',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fails','');
        }

        SeminarPKL::create([
            'nim' => $request->nim,
            'status' => 'Pengajuan',
            'id_dospem' => $request->id_dospem,
            'tgl_seminar' => $request->tgl_seminar,
            'waktu_seminar' => $request->waktu_seminar_mulai . '-' . $request->waktu_seminar_selesai,
            'ruang' => $request->ruang,
            'scan_layak_seminar' => $request->file('scan_layak_seminar')->storeAs('private/scan_layak_seminar', $request->nim . '-' . now()->format('YmdHis') . '.' . $request->file('scan_layak_seminar')->extension()),
            'scan_peminjaman_ruang' => $request->file('scan_peminjaman_ruang')->storeAs('private/scan_peminjaman_ruang', $request->nim . '-' . now()->format('YmdHis') . '.' . $request->file('scan_peminjaman_ruang')->extension()),
        ]);
        return redirect()->back()->with('success', 'Berhasil mendaftar seminar.');
    }

    public function daftarUlangSeminar (UpdateSeminarPKLRequest $request)
    {
        $validator = validator($request->all(), [
            'id_dospem' => 'required',
            'tgl_seminar' => 'required|date',
            'waktu_seminar_mulai' => 'required',
            'waktu_seminar_selesai' => 'required',
            'ruang' => 'required',
            'scan_layak_seminar' => 'sometimes|file|mimes:pdf|max:1500',
            'scan_peminjaman_ruang' => 'sometimes|file|mimes:pdf|max:1500',
        ], [
            'required' => ':attribute harus diisi.',
            'date' => ':attribute harus berupa tanggal.',
            'mimes' => ':attribute harus berupa file pdf.',
            'max' => ':attribute maksimal 1.5MB.',
        ], [
            'id_dospem' => 'ID Dosen Pembimbing',
            'tgl_seminar' => 'Tanggal Seminar',
            'waktu_seminar_mulai' => 'Waktu Seminar Awal',
            'waktu_seminar_selesai' => 'Waktu Seminar Akhir',
            'ruang' => 'Ruang Seminar',
            'scan_layak_seminar' => 'Scan Surat Keterangan Layak Seminar',
            'scan_peminjaman_ruang' => 'Scan Surat Peminjaman Ruang',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fails','');
        }

        $new_data = [
            'id_dospem' => $request->id_dospem,
            'tgl_seminar' => $request->tgl_seminar,
            'waktu_seminar' => $request->waktu_seminar_mulai . '-' . $request->waktu_seminar_selesai,
            'ruang' => $request->ruang,
            'pesan' => null,
        ];
        if ($request->scan_layak_seminar) {
            if ($request->scan_layak_seminar_old) {
                Storage::delete($request->scan_layak_seminar_old);
            }
            $new_data['scan_layak_seminar'] = $request->file('scan_layak_seminar')->storeAs('private/scan_layak_seminar', $request->nim . '-' . now()->format('YmdHis') . '.' . $request->file('scan_layak_seminar')->extension());
        }
        if ($request->scan_peminjaman_ruang) {
            if ($request->scan_peminjaman_ruang_old) {
                Storage::delete($request->scan_peminjaman_ruang_old);
            }
            $new_data['scan_peminjaman_ruang'] = $request->file('scan_peminjaman_ruang')->storeAs('private/scan_peminjaman_ruang', $request->nim . '-' . now()->format('YmdHis') . '.' . $request->file('scan_peminjaman_ruang')->extension());
        }
        SeminarPKL::where('nim', $request->nim)->update($new_data);

        return redirect()->back()->with('success', 'Berhasil mendaftar ulang seminar.');
    }
}
