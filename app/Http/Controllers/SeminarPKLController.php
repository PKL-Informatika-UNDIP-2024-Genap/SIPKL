<?php

namespace App\Http\Controllers;

use App\Models\SeminarPKL;
use App\Http\Requests\StoreSeminarPKLRequest;
use App\Http\Requests\UpdateSeminarPKLRequest;

class SeminarPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.seminar.index');
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
    public function store(StoreSeminarPKLRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SeminarPKL $seminarPKL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeminarPKL $seminarPKL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeminarPKLRequest $request, SeminarPKL $seminarPKL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeminarPKL $seminarPKL)
    {
        //
    }
}
