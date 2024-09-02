<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function update_password(Request $request)
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
        auth()->user()->update_password($request->password_baru);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function update_no_wa(Request $request)
    {
        $request->validate([
            'no_wa' => 'required|numeric|digits_between:6,20|unique:mahasiswa,no_wa,' . auth()->user()->mahasiswa->nim . ',nim',
        ], [
            'no_wa.required' => 'Nomor Whatsapp harus diisi',
            'no_wa.numeric' => 'Nomor Whatsapp harus berupa angka',
            'no_wa.digits_between' => 'No. WA harus berisi 6-20 angka',
            'no_wa.unique' => 'Nomor Whatsapp sudah terdaftar',
        ]);
        Mahasiswa::update_no_wa($request->no_wa);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function update_email(Request $request)
    {
        $messages = [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ];
        if (auth()->user()->is_admin) {
            $request->validate([
                'email' => 'required|email|unique:koordinator,email' . (auth()->user()->koordinator->email == $request->email ? '' : '|unique:mahasiswa,email'),
            ], $messages);
            Koordinator::update_email($request->email);
        } else {
            $request->validate([
                'email' => 'required|email|unique:mahasiswa,email' . (auth()->user()->mahasiswa->email == $request->email ? '' : '|unique:koordinator,email'),
            ], $messages);
            Mahasiswa::update_email($request->email);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function update_foto_profil(Request $request)
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
            // Development
            if (file_exists(public_path('/'.$old_foto_profil))) {
                unlink(public_path('/'.$old_foto_profil));
            }
            // Stage & Production
            // if (file_exists(base_path('../public_html/'.$old_foto_profil))) {
            //     unlink(base_path('../public_html/'.$old_foto_profil));
            // }
            // end
        }
        $extension = $request->file('foto_profil')->getClientOriginalExtension();
        $new_filename = auth()->user()->username.'-'.now()->timestamp.'-'.uniqid().'.'.$extension;
        // Development
        $request->file('foto_profil')->move(public_path('/images/foto_profil'), $new_filename);
        // Stage & Production
        // $request->file('foto_profil')->move(base_path('../public_html/images/foto_profil'), $new_filename);
        // end
        User::update_foto_profil('images/foto_profil/' . $new_filename);

        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
            'foto_profil' => auth()->user()->foto_profil,
        ], 200);
    }


    public function update_golongan(Request $request)
    {
        $request->validate([
            'golongan' => 'required',
        ], [
            'golongan.required' => 'Golongan harus diisi',
        ]);
        Koordinator::update_golongan($request->golongan);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }

    public function update_jabatan(Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
        ], [
            'jabatan.required' => 'Jabatan harus diisi',
        ]);
        Koordinator::update_jabatan($request->jabatan);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }
}
