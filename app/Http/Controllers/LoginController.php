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
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function dashboard(){
        // dd(auth()->user()->username);
        if(auth()->user()->is_admin == 1){
            return view('koordinator.dashboard');
        }else{
            return view('mahasiswa.dashboard');
        }
    }

    public function editData(){
        return view('mahasiswa.update_data');
    }

    public function updateDataMahasiswa(Request $request){
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        request()->no_wa = str_replace(['+', ' ', '_'], '', $request->no_wa);
        $validatedData = $request->validate([
            'email' => 'required|unique:mahasiswa|regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
            // 'no_wa' => 'required|max:20|regex:/^[0-9]{1,20}$/',
            'password' => 'required|min:8|max:32|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'konfirmasi_password' => 'required|same:password',
        ], [
            'password.regex' => 'Password must contain at least one letter and one number',
            'konfirmasi_password.same' => 'Konfirmasi Password field must match Password Baru',
        ]);
        $validatedData['no_wa'] = request()->no_wa;

        $validatedDataPKL = $request->validate([
            'instansi' => 'required',
            'judul' => 'required',
        ]);
        $validatedDataPKL['id'] = substr($mahasiswa->nim,6);
        $validatedDataPKL['nim'] = $mahasiswa->nim;
        //status default 0

        $new_password = Hash::make($validatedData['password']);

        unset($validatedData['password']);
        unset($validatedData['konfirmasi_password']);

        // dd($validatedData,$validatedDataPKL);
        $mahasiswa->update($validatedData);
        PKL::create($validatedDataPKL);
        $user->update(['password' => $new_password]);

        return redirect('/dashboard')->with('success', 'Data updated successfully');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
