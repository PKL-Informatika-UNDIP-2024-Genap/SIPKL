<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PKL;
use App\Models\PeriodePKL;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Requests\StorePKLRequest;
use App\Http\Requests\UpdatePKLRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        return view('mahasiswa.pkl.index', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'pkl' => $mahasiswa->pkl,
        ]);
    }

    /**
     * Show the form for registrasi PKL.
     */
    public function registrasi()
    {
        // middleware status.mhs:Praregistrasi, tapi dialihkan ke pkl
        if (auth()->user()->mahasiswa->pkl->status != 'Praregistrasi') {
            return redirect('/pkl');
        }
        $periode_sekarang = PeriodePKL::where('tgl_selesai', '>=', date('Y-m-d'))->where('tgl_mulai', '<', date('Y-m-d'))->orderBy('tgl_mulai', 'desc')->first();
        return view('mahasiswa.registrasi_pkl', [
            'periode_sekarang' => $periode_sekarang->id_periode,
            'user' => auth()->user(),
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

    /**
     * Delete a file from temporary storage.
     */
    public function tmpDelete(Request $request) {
        $tmp_file = TemporaryFile::where('folder', request()->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('private/scan_irs/tmp/'.$tmp_file->folder);
            $tmp_file->delete();
        }
        return response('');
    }

    /**
     * Submit form registrasi PKL.
     */
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
            
            $pkl_old = PKL::where('nim', $request->nim)->select(['scan_irs'])->first();
            if ($pkl_old->scan_irs != null){
                Storage::delete($pkl_old->scan_irs);
            }

            PKL::where('nim', $request->nim)->update([
                'status' => 'Registrasi',
                'instansi' => $request->instansi,
                'judul' => $request->judul,
                'scan_irs' => 'private/scan_irs/'.$new_filename,
                'tgl_registrasi' => now(),
                'pesan' => null,
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

    /**
     * Update data PKL.
     */
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

    /**
     * Display laporan PKL.
     */
    public function laporan() {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        $pkl = $mahasiswa->pkl;
        if ($pkl->tgl_laporan) {
            $carbon = Carbon::parse($pkl->tgl_laporan);
            $tgl_laporan = $carbon->isoFormat('D MMMM YYYY');
            $waktu_laporan = $carbon->format('H.i');
        }
        return view('mahasiswa.laporan.index', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'pkl' => $pkl,
            'tgl_laporan' => $tgl_laporan ?? '',
            'waktu_laporan' => $waktu_laporan ?? '',
        ]);
    }

    /**
     * Send Laporan PKL.
     */
    public function kirimLaporan(UpdatePKLRequest $request) {
        $validator = validator($request->all(), [
            'instansi' => 'required',
            'judul' => 'required',
            'link_laporan' => 'required|url',
            'abstrak' => 'required',
            'keyword1' => 'required',
            'keyword2' => 'required',
            'keyword3' => 'required',
        ], [
            'required' => ':attribute harus diisi.',
            'url' => ':attribute harus berupa URL.',
        ], [
            'instansi' => 'Instansi',
            'judul' => 'Judul',
            'link_laporan' => 'Link Laporan',
            'abstrak' => 'Abstrak',
            'keyword1' => 'Kata kunci 1',
            'keyword2' => 'Kata kunci 2',
            'keyword3' => 'Kata kunci 3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fails', '');
        }

        $new_data = $validator->validated() + [
            'status' => 'Laporan',
            'tgl_laporan' => now(),
            'pesan' => null,
        ];
        if ($request->keyword4) {
            $new_data['keyword4'] = $request->keyword4;
        }
        if ($request->keyword5) {
            if ($request->keyword4 == null) {
                $new_data['keyword4'] = $request->keyword5;
            } else {
                $new_data['keyword5'] = $request->keyword5;
            }
        }

        PKL::where('nim', $request->nim)->update($new_data);
        
        return redirect()->back()->with('success', 'Berhasil mengirim laporan PKL.');
    }
}
