<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\SeminarPKL;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSeminarPKLRequest;
use App\Http\Requests\UpdateSeminarPKLRequest;

class SeminarPKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        if ($mahasiswa->status == 'Lulus') {
            return view('mahasiswa.seminar.index__lulus', [
                'user' => $user,
                'mahasiswa' => $mahasiswa,
            ]);
        }
        if ($mahasiswa->status == 'Nonaktif') {
            return view('mahasiswa.seminar.index__nonaktif', [
                'user' => $user,
                'mahasiswa' => $mahasiswa,
            ]);
        }
        $seminar_pkl = $mahasiswa->seminar_pkl;
        // setlocale(LC_TIME, 'id_ID');
        // Carbon::setLocale('id');
        $hari_tgl_seminar = null;
        if ($seminar_pkl != null){
            $hari_tgl_seminar =  Carbon::parse($seminar_pkl->tgl_seminar)->isoFormat('dddd, D MMMM Y');
        }
        return view('mahasiswa.seminar.index', [
            'user' => $user,
            'mahasiswa' => $mahasiswa,
            'seminar_pkl' => $seminar_pkl,
            'hari_tgl_seminar' => $hari_tgl_seminar,
        ]);
    }

    /**
     * Daftar seminar Tak Terjadwal.
     */
    public function daftar_seminar(StoreSeminarPKLRequest $request)
    {
        $waktu_mulai = substr($request->waktu_seminar_mulai, 0, 2)*60 + substr($request->waktu_seminar_mulai, 3, 2);
        $validator = validator($request->all(), [
            'nim' => 'required',
            'id_dospem' => 'required',
            'tgl_seminar' => 'required|date|after_or_equal:today',
            'waktu_seminar_mulai' => ['required',
                function ($attribute, $value, $fail) use ($request, $waktu_mulai) {
                    if ($request->tgl_seminar == now()->format('Y-m-d')) {
                        $waktu_sekarang = now()->format('H:i');
                        $waktu_sekarang = substr($waktu_sekarang, 0, 2)*60 + substr($waktu_sekarang, 3, 2);
                        if ($waktu_mulai <= $waktu_sekarang) {
                            $fail(':attribute harus setelah waktu sekarang.');
                        }
                    }
                }
            ],
            'waktu_seminar_selesai' => ['required',
                function ($attribute, $value, $fail) use ($waktu_mulai) {
                    $waktu_selesai = substr($value, 0, 2)*60 + substr($value, 3, 2);
                    // minimal 30 menit durasi
                    if ($waktu_selesai <= $waktu_mulai) {
                        $fail(':attribute harus setelah waktu mulai seminar.');
                    }
                    if ($waktu_selesai - $waktu_mulai < 30) {
                        $fail(':attribute minimal 30 menit setelah waktu mulai seminar.');
                    }
                }
            ],
            'ruang' => ['required',
                function ($attribute, $value, $fail) {
                    if (strlen($value) > 10) {
                        $fail(':attribute maksimal 10 karakter.');
                    }
                }
            ],
            'scan_layak_seminar' => 'required|image|mimes:jpeg,png,jpg|max:500',
            'scan_peminjaman_ruang' => 'required|image|mimes:jpeg,png,jpg|max:500',
        ], [
            'required' => ':attribute harus diisi.',
            'date' => ':attribute harus berupa tanggal.',
            'mimes' => ':attribute harus berupa file gambar jpeg, jpg, atau png.',
            'max' => ':attribute maksimal 0.5MB.',
            'after_or_equal' => ':attribute harus tanggal hari ini atau setelahnya.',
        ], [
            'nim' => 'NIM',
            'id_dospem' => 'ID Dosen Pembimbing',
            'tgl_seminar' => 'Tanggal Seminar',
            'waktu_seminar_mulai' => 'Waktu Mulai Seminar',
            'waktu_seminar_selesai' => 'Waktu Selesai Seminar',
            'ruang' => 'Ruang Seminar',
            'scan_layak_seminar' => 'Scan Surat Keterangan Layak Seminar',
            'scan_peminjaman_ruang' => 'Scan Surat Peminjaman Ruang',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fails','');
        }

        SeminarPKL::create([
            'nim' => $request->nim,
            'status' => 'Pengajuan',
            'id_dospem' => $request->id_dospem,
            'tgl_seminar' => $request->tgl_seminar,
            'waktu_seminar' => $request->waktu_seminar_mulai . '-' . $request->waktu_seminar_selesai,
            'ruang' => $request->ruang,
            'scan_layak_seminar' => $request->file('scan_layak_seminar')->storeAs('private/scan_layak_seminar', $request->nim . '-' . now()->format('YmdHis') . '.' . $request->file('scan_layak_seminar')->extension()),
            'scan_peminjaman_ruang' => $request->file('scan_peminjaman_ruang')->storeAs('private/scan_peminjaman_ruang', $request->nim . '-' . now()->format('YmdHis') . '.' . $request->file('scan_peminjaman_ruang')->extension()),
        ]);
        return redirect()->back()->with('success', 'Berhasil mendaftar seminar.');
    }

    public function daftar_ulang_seminar(UpdateSeminarPKLRequest $request)
    {
        $waktu_mulai = substr($request->waktu_seminar_mulai, 0, 2)*60 + substr($request->waktu_seminar_mulai, 3, 2);
        $rules = [
            'id_dospem' => 'required',
            'tgl_seminar' => 'required|date|after_or_equal:today',
            'waktu_seminar_mulai' => ['required',
                function ($attribute, $value, $fail) use ($request, $waktu_mulai) {
                    if ($request->tgl_seminar == now()->format('Y-m-d')) {
                        $waktu_sekarang = now()->format('H:i');
                        $waktu_sekarang = substr($waktu_sekarang, 0, 2)*60 + substr($waktu_sekarang, 3, 2);
                        if ($waktu_mulai <= $waktu_sekarang) {
                            $fail(':attribute harus setelah waktu sekarang.');
                        }
                    }
                }
            ],
            'waktu_seminar_selesai' => ['required',
                function ($attribute, $value, $fail) use ($waktu_mulai) {
                    $waktu_selesai = substr($value, 0, 2)*60 + substr($value, 3, 2);
                    // minimal 30 menit durasi
                    if ($waktu_selesai <= $waktu_mulai) {
                        $fail(':attribute harus setelah waktu mulai seminar.');
                    }
                    if ($waktu_selesai - $waktu_mulai < 30) {
                        $fail(':attribute minimal 30 menit setelah waktu mulai seminar.');
                    }
                }
            ],
            'ruang' => ['required',
                function ($attribute, $value, $fail) {
                    if (strlen($value) > 10) {
                        $fail(':attribute maksimal 10 karakter.');
                    }
                }
            ],
            'scan_layak_seminar' => 'sometimes|image|mimes:jpeg,png,jpg|max:500',
            'scan_peminjaman_ruang' => 'sometimes|image|mimes:jpeg,png,jpg|max:500',
        ];

        if ($request->scan_layak_seminar_old === null) {
            $rules['scan_layak_seminar'] = 'required|image|mimes:jpeg,png,jpg|max:500';
        }
        if ($request->scan_peminjaman_ruang_old === null) {
            $rules['scan_peminjaman_ruang'] = 'required|image|mimes:jpeg,png,jpg|max:500';
        }

        $validator = validator($request->all(), $rules, [
            'required' => ':attribute harus diisi.',
            'date' => ':attribute harus berupa tanggal.',
            'mimes' => ':attribute harus berupa file gambar jpeg, jpg, atau png.',
            'max' => ':attribute maksimal 0.5MB.',
            'after_or_equal' => ':attribute harus tanggal hari ini atau setelahnya.',
        ], [
            'id_dospem' => 'ID Dosen Pembimbing',
            'tgl_seminar' => 'Tanggal Seminar',
            'waktu_seminar_mulai' => 'Waktu Mulai Seminar',
            'waktu_seminar_selesai' => 'Waktu Selesai Seminar',
            'ruang' => 'Ruang Seminar',
            'scan_layak_seminar' => 'Scan Surat Keterangan Layak Seminar',
            'scan_peminjaman_ruang' => 'Scan Surat Peminjaman Ruang',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fails','');
        }

        $new_data = [
            'status' => 'Pengajuan',
            'id_dospem' => $request->id_dospem,
            'tgl_seminar' => $request->tgl_seminar,
            'waktu_seminar' => $request->waktu_seminar_mulai . '-' . $request->waktu_seminar_selesai,
            'ruang' => $request->ruang,
            'pesan' => null,
            'created_at' => now(),
        ];
        if ($request->scan_layak_seminar) {
            if ($request->scan_layak_seminar_old) {
                Storage::delete($request->scan_layak_seminar_old);
            }
            $new_data['scan_layak_seminar'] = $request->file('scan_layak_seminar')->storeAs('private/scan_layak_seminar', $request->nim . '-' . now()->format('YmdHis') . '.' . $request->file('scan_layak_seminar')->extension());
        }
        if ($request->scan_peminjaman_ruang) {
            if ($request->scan_peminjaman_ruang_old) {
                Storage::delete($request->scan_peminjaman_ruang_old);
            }
            $new_data['scan_peminjaman_ruang'] = $request->file('scan_peminjaman_ruang')->storeAs('private/scan_peminjaman_ruang', $request->nim . '-' . now()->format('YmdHis') . '.' . $request->file('scan_peminjaman_ruang')->extension());
        }
        SeminarPKL::where('nim', $request->nim)->update($new_data);

        return redirect()->back()->with('success', 'Berhasil mendaftar ulang seminar.');
    }

    public function jadwal_seminar()
    {
        return view('mahasiswa.seminar.jadwal_seminar', [
            'user' => auth()->user(),
            'mahasiswa' => auth()->user()->mahasiswa,
            'data_jadwal' => SeminarPKL::get_data_jadwal_mendatang(),
        ]);
    }
}
