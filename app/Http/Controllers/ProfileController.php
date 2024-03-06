<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            return view('koordinator.profile.index', [
                'koordinator' => auth()->user()->koordinator,
            ]);
        } else {
            $user = auth()->user();
            $mahasiswa = $user->mahasiswa;
            return view('mahasiswa.profile.index', [
                'user' => $user,
                'mahasiswa' => $mahasiswa,
                'pkl' => $mahasiswa->pkl,
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Password lama tidak sesuai');
                    }
                },
            ],
            'password_baru' => 'required|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'konfirmasi_password_baru' => 'required|same:password_baru',
        ], [
            'password_lama.required' => 'Password lama harus diisi',
            'password_baru.required' => 'Password baru harus diisi',
            'password_baru.min' => 'Password baru minimal 8 karakter. ',
            'password_baru.max' => 'Password baru maksimal 32 karakter',
            'password_baru.regex' => 'Password baru harus mengandung huruf dan angka',
            'konfirmasi_password_baru.required' => 'Konfirmasi password baru harus diisi',
            'konfirmasi_password_baru.same' => 'Konfirmasi password baru tidak sesuai',
        ]);
        auth()->user()->update([
            'password' => Hash::make($request->password_baru),
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function updateNoWa(Request $request)
    {
        $request->validate([
            'no_wa' => 'required|numeric|digits_between:6,20',
        ], [
            'no_wa.required' => 'Nomor Whatsapp harus diisi',
            'no_wa.numeric' => 'Nomor Whatsapp harus berupa angka',
            'no_wa.digits_between' => 'No. WA harus berisi 6-20 angka',
        ]);
        auth()->user()->mahasiswa->update([
            'no_wa' => $request->no_wa,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->user()->username . ',username',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ]);
        auth()->user()->update([
            'email' => $request->email,
        ]);
        if (auth()->user()->is_admin) {
            auth()->user()->koordinator()->update([
                'email' => $request->email,
            ]);
        } else {
            auth()->user()->mahasiswa()->update([
                'email' => $request->email,
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function updateFotoProfil(Request $request)
    {
        $validator = validator($request->all(), [
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:500',
        ], [
            'foto_profil.required' => 'Foto profil harus diisi',
            'foto_profil.image' => 'Foto profil harus berupa file gambar',
            'foto_profil.mimes' => 'Foto profil harus berupa file gambar jpeg, jpg, atau png',
            'foto_profil.max' => 'Foto profil maksimal 500KB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Request failed',
            ], 400);
        }

        if (auth()->user()->foto_profil != null){
            $old_foto_profil = auth()->user()->foto_profil;
            if (file_exists(public_path('/'.$old_foto_profil))) {
                unlink(public_path('/'.$old_foto_profil));
            }
        }
        $extension = $request->file('foto_profil')->getClientOriginalExtension();
        $new_filename = auth()->user()->username.'-'.now()->timestamp.'-'.uniqid().'.'.$extension;
        $request->file('foto_profil')->move(public_path('/images/foto_profil'), $new_filename);
        auth()->user()->update([
            'foto_profil' => 'images/foto_profil/' . $new_filename,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
            'foto_profil' => auth()->user()->foto_profil,
        ], 200);
    }


    public function updateGolongan(Request $request)
    {
        $request->validate([
            'golongan' => 'required',
        ], [
            'golongan.required' => 'Golongan harus diisi',
        ]);
        auth()->user()->koordinator()->update([
            'golongan' => $request->golongan,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function updateJabatan(Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
        ], [
            'jabatan.required' => 'Jabatan harus diisi',
        ]);
        auth()->user()->koordinator()->update([
            'jabatan' => $request->jabatan,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }
}
