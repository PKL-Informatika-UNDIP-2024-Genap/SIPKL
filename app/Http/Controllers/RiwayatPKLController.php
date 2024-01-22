<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPKL;
use App\Http\Requests\StoreRiwayatPKLRequest;
use App\Http\Requests\UpdateRiwayatPKLRequest;

class RiwayatPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.riwayat_pkl');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiwayatPKLRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatPKL $riwayatPKL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatPKL $riwayatPKL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiwayatPKLRequest $request, RiwayatPKL $riwayatPKL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatPKL $riwayatPKL)
    {
        //
    }
}
