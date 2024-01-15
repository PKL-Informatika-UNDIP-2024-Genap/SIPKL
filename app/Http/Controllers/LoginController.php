<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

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

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
