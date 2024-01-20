<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Http\Requests\StorePengumumanRequest;
use App\Http\Requests\UpdatePengumumanRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koordinator.informasi.pengumuman.kelola_pengumuman', [
            'arr_pengumuman' => Pengumuman::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'deskripsi' => 'required|max:255',
            'lampiran' => 'required|max:255',
        ],
        [
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.max' => 'Deskripsi maksimal 255 karakter',
            'lampiran.required' => 'Lampiran tidak boleh kosong',
            'lampiran.max' => 'Lampiran maksimal 255 karakter',
        ]);

        Pengumuman::create($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validatedData = $request->validate([
            'deskripsi' => 'required|max:255',
            'lampiran' => 'required|max:255',
        ],
        [
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.max' => 'Deskripsi maksimal 255 karakter',
            'lampiran.required' => 'Lampiran tidak boleh kosong',
            'lampiran.max' => 'Lampiran maksimal 255 karakter',
        ]);
        
        $pengumuman->update($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function update_tabel_pengumuman()
    {
        $pengumuman = Pengumuman::all();
        $view = view('koordinator.informasi.pengumuman.update_tabel_pengumuman', [
            'arr_pengumuman' => $pengumuman
        ])->render();

        return response()->json([
            'status' => 200,
            'view' => $view,
        ]);
    }
}
