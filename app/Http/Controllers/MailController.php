<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //send email
    public function sendOtp(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Password tidak sesuai');
                    }
                },
            ],
        ]);
        if (session('otp')) {
            return response()->json(['message' => 'Email sudah dikirim']);
        }
        //generate otp
        $otp = rand(100000, 999999);
        //store otp in session
        session(['otp' => $otp]);
        //send email
        Mail::to(auth()->user()->email)->send(new EmailVerification($otp));
        return back()->with('success', 'Email berhasil dikirim');
    }
    
    public function verifikasiOtp(Request $request)
    {
        request()->validate([
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if ($value != auth()->user()->email) {
                        $fail('Email tidak sesuai');
                    }
                },
            ],
            'otp' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value != session('otp')) {
                        $fail('OTP tidak sesuai');
                    }
                },
            ],
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'otp.required' => 'OTP harus diisi',
            'otp.numeric' => 'OTP harus berupa angka',
        ]);
        if ($request->otp == session('otp')) {
            auth()->user()->update([
                'email_verified_at' => now(),
            ]);
            session()->forget('otp');
            return redirect()->route('profile')->with('success', 'Email berhasil diverifikasi');
        }
    }
}
