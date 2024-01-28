<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use App\Models\PeriodePKL;
use App\Http\Requests\StorePeriodePKLRequest;
use App\Http\Requests\UpdatePeriodePKLRequest;
use Illuminate\Http\Request;

class PeriodePKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koordinator.pkl.kelola_periode.index', [
            'data_periode' => PeriodePKL::all(),
        ]);
    }
}
