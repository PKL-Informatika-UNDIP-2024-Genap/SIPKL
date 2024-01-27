<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('mahasiswa.profile.index', [
            'mahasiswa' => auth()->user()->mahasiswa,
        ]);
    }
}
