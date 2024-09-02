<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Http\Requests\StoreDokumenRequest;
use App\Http\Requests\UpdateDokumenRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koordinator.informasi.dokumen.kelola_dokumen', [
            'arr_dokumen' => Dokumen::get_data_dokumen(),
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

        Dokumen::create($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokumen $dokumen)
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
        
        $dokumen->update($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokumen $dokumen)
    {
        $dokumen->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function update_tabel_dokumen()
    {
        $dokumen = Dokumen::all();
        $view = view('koordinator.informasi.dokumen.update_tabel_dokumen', [
            'arr_dokumen' => $dokumen
        ])->render();

        return response()->json([
            'status' => 200,
            'view' => $view,
        ]);
    }
}
