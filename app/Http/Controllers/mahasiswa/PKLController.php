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
        if (auth()->user()->mahasiswa->dosen_pembimbing == null) {
            return view('mahasiswa.registrasi_pkl.index__nopembimbing', [
                'user' => auth()->user(),
                'mahasiswa' => auth()->user()->mahasiswa,
                'pkl' => auth()->user()->mahasiswa->pkl,
            ]);
        }
        $periode_sekarang = PeriodePKL::where('tgl_selesai', '>=', date('Y-m-d'))->where('tgl_mulai', '<', date('Y-m-d'))->orderBy('tgl_mulai', 'desc')->first();
        return view('mahasiswa.registrasi_pkl.index', [
            'periode_sekarang' => $periode_sekarang->id_periode,
            'user' => auth()->user(),
            'mahasiswa' => auth()->user()->mahasiswa,
            'pkl' => auth()->user()->mahasiswa->pkl,
        ]);
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
            'scan_irs' => 'required|image|mimes:jpeg,png,jpg|max:500',
        ], [
            'required' => ':attribute harus diisi.',
            'image' => ':attribute harus berupa file gambar.',
            'mimes' => ':attribute harus berupa file gambar jpeg, jpg, atau png.',
            'max' => ':attribute maksimal 500KB.',
        ], [
            // 'periode' => 'Periode PKL',
            'instansi' => 'Instansi',
            'judul' => 'Judul',
            'scan_irs' => 'Scan IRS',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pkl_old = PKL::where('nim', $request->nim)->select(['scan_irs'])->first();
        if ($pkl_old->scan_irs != null){
            Storage::delete($pkl_old->scan_irs);
        }

        $extension = $request->file('scan_irs')->getClientOriginalExtension();
        $new_filename = auth()->user()->username.'-'.now()->timestamp.'-'.uniqid().'.'.$extension;
        PKL::where('nim', $request->nim)->update([
            'status' => 'Registrasi',
            'instansi' => $request->instansi,
            'judul' => $request->judul,
            'scan_irs' => $request->file('scan_irs')->storeAs('private/scan_irs', $new_filename),
            'tgl_registrasi' => now(),
            'pesan' => null,
        ]);

        return redirect()->route('pkl.index')->with('success', 'Berhasil mengajukan registrasi PKL.');
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
        if ($pkl->link_laporan != null && $pkl->link_laporan.substr(0, 7) != 'http://' && $pkl->link_laporan.substr(0, 8) != 'https://' && $pkl->link_laporan.substr(0, 2) != '//') {
            $pkl->link_laporan = 'http://'.$pkl->link_laporan;
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
