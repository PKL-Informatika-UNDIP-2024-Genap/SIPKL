<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; // Add this line

class LoginController extends Controller
{
    public function authenticate(Request $request){
        // dd($request->all());
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // dd($request->session()->regenerate());
            return redirect()->intended('/dashboard')->with('success', 'Berhasil login!');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function dashboard(){
        // dd(auth()->user()->username);
        if(auth()->user()->is_admin == 1){
            return view('koordinator.dashboard');
        }else{
            return view('mahasiswa.dashboard', [
                'mahasiswa' => auth()->user()->mahasiswa,
                // 'pkl' => auth()->user()->mahasiswa->pkl,
            ]);
        }
    }

    public function editData(){
        // middleware 'DataNotUpdated' in disguise
        if (auth()->user()->mahasiswa->email != null){
            return redirect('/dashboard');
        }
        return view('mahasiswa.update_data');
    }

    public function updateDataMahasiswa(Request $request){
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        request()->no_wa = str_replace(['+', ' ', '_'], '', $request->no_wa);
        $request->merge(['no_wa' => request()->no_wa]);
        $validatedData = $request->validate([
            'email' => 'required|unique:mahasiswa|regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
            // 'no_wa' => 'required|max:20|regex:/^[0-9]{1,20}$/',
            'no_wa' => 'required|min:6|unique:mahasiswa',
            'password' => 'required|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'konfirmasi_password' => 'required|same:password',
        ], [
            'email.required' => 'Alamat email harus diisi',
            'email.regex' => 'Format alamat email tidak valid',
            'email.unique' => 'Alamat email sudah digunakan',
            'no_wa.required' => 'Nomor Whatsapp harus diisi',
            'no_wa.min' => 'Nomor Whatsapp terlalu pendek',
            'no_wa.unique' => 'Nomor Whatsapp sudah digunakan',
            'password.required' => 'Password baru harus diisi',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.max' => 'Password baru maksimal 32 karakter',
            'password.regex' => 'Password baru harus mengandung huruf dan angka',
            'konfirmasi_password.required' => 'Konfirmasi password baru harus diisi',
            'konfirmasi_password.same' => 'Konfirmasi password baru tidak sesuai',
        ]);

        $validatedDataPKL = $request->validate([
            'instansi' => 'required',
            'judul' => 'required',
        ], [
            'instansi.required' => 'Instansi harus diisi',
            'judul.required' => 'Judul PKL harus diisi',
        ]);
        $validatedDataPKL['nim'] = $mahasiswa->nim;
        //status default 0

        $new_password = Hash::make($validatedData['password']);

        $mahasiswa->update([
            'email' => $validatedData['email'],
            'no_wa' => $validatedData['no_wa'],
            'status' => 'Nonaktif',
        ]);
        PKL::create($validatedDataPKL);
        $user->update([
            'email' => $validatedData['email'],
            'password' => $new_password,
        ]);

        return redirect('/dashboard')->with('success', 'Data berhasil diperbarui. Selamat Datang di SIPKL Informatika Undip!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
