<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function preview($filename)
    {
        $path = Storage::path('\\'.$filename);
        return response()->file($path);
    }

    public function download_file($filename){
        $path = Storage::path('\\'.$filename);
        return response()->download($path);
    }
}
