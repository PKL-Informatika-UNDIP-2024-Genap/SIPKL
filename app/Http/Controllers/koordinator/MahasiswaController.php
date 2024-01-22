<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\PKL;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koordinator.mhs.kelola_mhs.index', [
            'arr_mhs' => Mahasiswa::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswa|max:25',
        ],
        [
            'nama.required' => 'Nama tidak boleh kosong',
            'nim.required' => 'NIM tidak boleh kosong',
            'nim.unique' => 'NIM sudah terdaftar',
            'nim.max' => 'NIM maksimal 25 karakter',
        ]);

        Mahasiswa::create($validatedData);

        $userData = [
            "username" => $validatedData['nim'],
            "password" => Hash::make($validatedData['nim']),
            "is_admin" => 0,
            "status" => "1",

        ];

        User::create($userData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'nim' => ['required', Rule::unique('mahasiswa')->ignore($request->nim, 'nim')],
            'status' => 'required',
        ],
        [
            'nama.required' => 'Nama tidak boleh kosong',
            'nim.required' => 'NIM tidak boleh kosong',
            'nim.unique' => 'NIM sudah terdaftar',
            'nim.max' => 'NIM maksimal 25 karakter',
            'status.required' => 'Status tidak boleh kosong',
        ]);

        Mahasiswa::where('nim', $request->nim)->update($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function reset_password($nim){
        User::where('username', $nim)->update([
            'password' => Hash::make($nim),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        User::where('username', $mahasiswa->nim)->delete();
        $mahasiswa->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function update_tabel_mhs()
    {
        $mhs = Mahasiswa::all();
        $view = view('koordinator.mhs.kelola_mhs.update_tabel_mhs', [
            'arr_mhs' => $mhs
        ])->render();

        return response()->json([
            'status' => 200,
            'view' => $view,
        ]);
    }

    public function get_data_pkl($nim)
    {
        $pkl = PKL::where('nim', $nim)->first();

        return response()->json([
            'status' => 200,
            'pkl' => $pkl,
        ]);
    }
}
