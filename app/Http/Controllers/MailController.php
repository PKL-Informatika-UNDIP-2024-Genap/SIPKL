<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //send email
    public function sendOtp()
    {
        Mail::to(auth()->user()->email)->send(new EmailVerification());
    }
}
