<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\InformasiLain;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInformasiLainRequest;
use App\Http\Requests\UpdateInformasiLainRequest;

class InformasiLainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koordinator.informasi.informasi_lain.index', [
            'arr_informasi_lain' => InformasiLain::get_data_informasi_lain()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InformasiLain $informasiLain)
    {
        $validatedData = $request->validate([
            'value' => 'required|max:255',
        ],
        [
            'value.required' => 'Value tidak boleh kosong',
            'value.max' => 'Value maksimal 255 karakter',
        ]);
        
        $informasiLain->update($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

}
