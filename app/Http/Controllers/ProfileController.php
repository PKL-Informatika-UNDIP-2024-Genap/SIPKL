<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('mahasiswa.profile.index', [
            'mahasiswa' => auth()->user()->mahasiswa,
        ]);
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
        auth()->user()->mahasiswa->update([
            'email' => $request->email,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }
}
