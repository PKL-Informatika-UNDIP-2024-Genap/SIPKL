<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use App\Models\PeriodePKL;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Requests\StorePKLRequest;
use App\Http\Requests\UpdatePKLRequest;
use Illuminate\Support\Facades\Storage;

class PKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.pkl.index', [
            'mahasiswa' => auth()->user()->mahasiswa,
            'pkl' => auth()->user()->mahasiswa->pkl,
        ]);
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
    public function store(StorePKLRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PKL $pKL)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PKL $pKL)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePKLRequest $request, PKL $pKL)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PKL $pKL)
    {
        //
    }

    public function registrasi()
    {
        // middleware status.mhs:Praregistrasi, tapi dialihkan ke pkl
        if (auth()->user()->mahasiswa->pkl->status != 'Praregistrasi') {
            return redirect('/pkl');
        }
        $periode_sekarang = PeriodePKL::where('tgl_selesai', '>=', date('Y-m-d'))->where('tgl_mulai', '<', date('Y-m-d'))->orderBy('tgl_mulai', 'desc')->first();
        return view('mahasiswa.registrasi_pkl', [
            'periode_sekarang' => $periode_sekarang->id_periode,
            'mahasiswa' => auth()->user()->mahasiswa,
            'pkl' => auth()->user()->mahasiswa->pkl,
        ]);
    }

    /**
     * Upload a file to temporary storage.
     */
    public function tmpUpload(Request $request)
    {
        if ($request->hasFile('scan_irs')) {
            $file = $request->file('scan_irs');
            $filename = $file->getClientOriginalName();
            $folder = uniqid('irs-') . '-' . now()->timestamp;
            $file->storeAs('private/scan_irs/tmp/' . $folder, $filename);
            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);
            return $folder;
        }
        return '';
    }

    public function tmpDelete(Request $request) {
        $tmp_file = TemporaryFile::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('private/scan_irs/tmp/'.$tmp_file->folder);
            $tmp_file->delete();
        }
        return response('');
    }

    public function submitRegistrasi(UpdatePKLRequest $request)
    {
        $validator = validator()->make($request->all(), [
            // 'periode' => 'required',
            'nim' => 'required',
            'instansi' => 'required',
            'judul' => 'required',
            'scan_irs' => 'required',
        ], [
            'required' => ':attribute harus diisi.',
        ], [
            // 'periode' => 'Periode PKL',
            'instansi' => 'Instansi',
            'judul' => 'Judul',
            'scan_irs' => 'Scan IRS',
        ]);

        $tmp_file = TemporaryFile::where('folder', $request->scan_irs)->first();
        if ($validator->fails() || !$tmp_file) {
            if ($tmp_file) {
                Storage::deleteDirectory('private/scan_irs/tmp/'.$tmp_file->folder);
                $tmp_file->delete();
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($tmp_file) {
            $extension = pathinfo(storage_path('/private/scan_irs/tmp/'.$tmp_file->folder.'/'.$tmp_file->filename), PATHINFO_EXTENSION);
            $new_filename = auth()->user()->username.'-'.now()->timestamp.'-'.uniqid().'.'.$extension;
            Storage::move('private/scan_irs/tmp/'.$tmp_file->folder.'/'.$tmp_file->filename, 'private/scan_irs/'.$new_filename);

            PKL::where('nim', $request->nim)->update([
                'status' => 'Registrasi',
                'instansi' => $request->instansi,
                'judul' => $request->judul,
                'scan_irs' => 'private/scan_irs/'.$new_filename,
                'tgl_registrasi' => now(),
            ]);
            // $mahasiswa->update([
            //     'periode_pkl' => $request->periode,
            // ]);
            Storage::deleteDirectory('private/scan_irs/tmp/'.$tmp_file->folder);
            $tmp_file->delete();
            return redirect()->route('pkl.index')->with('success', 'Berhasil mengubah data PKL.');
        }
        return redirect()->back();
    }

    public function updateData(UpdatePKLRequest $request, PKL $pkl) {
        $validatedData = $request->validate([
            'instansi' => 'required',
            'judul' => 'required',
        ], [
            'instansi.required' => 'Instansi tidak boleh kosong',
            'judul.required' => 'Judul tidak boleh kosong',
        ]);
        $pkl->update([
            'instansi' => $validatedData['instansi'],
            'judul' => $validatedData['judul'],
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Request successful',
        ], 200);
    }
}
