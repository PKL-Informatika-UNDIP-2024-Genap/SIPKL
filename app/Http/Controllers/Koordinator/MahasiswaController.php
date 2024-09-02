<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\DosenPembimbing;
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
        $status = '';
        if(isset($_GET['status'])){
            $status = $_GET['status'];
        }

        return view('koordinator.mhs.kelola_mhs.index', [
            'arr_mhs' => Mahasiswa::all(),
            'status' => $status,
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

    public function import(Request $request)
    {
        ini_set('max_execution_time', 18000);

        request()->validate([
            'file' => 'required|mimes:xlsx,xls',
        ],
        [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File harus berupa file excel',
        ]);

        try {
            $file = $request->file('file');

            $error = Mahasiswa::import($file);

            User::import($file);
        } catch (\PDOException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Request failed',
                'errors' => "Terdapat duplikasi data pada file excel",
            ], 500);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
            'error_row' => $error['error_row'],
            'error_message' => $error['error_message'],
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
        User::reset_password($nim);

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

    public function get_data_pkl_dospem(Request $request)
    {
        $pkl = PKL::where('nim', $request->nim)->first();
        $dospem = null;

        if($request->id_dospem != "-"){
            $dospem = DosenPembimbing::where('id', $request->id_dospem)->first();
        }

        return response()->json([
            'status' => 200,
            'judul_pkl' => $pkl->judul ?? "-",
            'instansi' => $pkl->instansi ?? "-",
            'nama_dospem' => $dospem->nama ?? "-",
        ]);
    }

    public function index_belum_selesai()
    {
        $arr_mhs = Mahasiswa::get_mhs_blm_selesai();

        $arr_nim = $arr_mhs->pluck('nim')->toArray();

        // dd($arr_nim);
        return view('koordinator.mhs.belum_selesai.index', [
            'arr_mhs' => $arr_mhs,
            'arr_nim' => $arr_nim,
        ]);
    }

    public function reset_status(){
        $arr_nim = request('arr_nim');
        
        Mahasiswa::reset_status_mhs_blm_selesai($arr_nim);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }
}
