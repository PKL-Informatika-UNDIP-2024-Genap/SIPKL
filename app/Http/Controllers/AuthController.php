<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\DosenPembimbing;
use App\Models\Mahasiswa;
use App\Models\Pengumuman;
use App\Models\PeriodePKL;
use App\Models\PKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\SeminarPKL;

class AuthController extends Controller
{
    public function landing()
    {
        return view('landing',[
            'data_pengumuman' => Pengumuman::get_data_pengumuman(),
            'data_dokumen' => Dokumen::get_data_dokumen(),
            'data_jadwal' => SeminarPKL::get_data_jadwal_mendatang(),
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|exists:users',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi',
            'username.exists' => 'Username tidak ditemukan',
            'password.required' => 'Password harus diisi',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->is_admin == 0){
                session(['buka_pesan' => 1]);
            }
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Gagal!')->withErrors(['password' => 'Password tidak sesuai!'])->withInput();
    }

    public function dashboard()
    {
        if(auth()->user()->is_admin == 1){
            $periode_aktif = PeriodePKL::whereRaw('CURDATE() BETWEEN tgl_mulai AND tgl_selesai')->select('id_periode')->first();
            $periode_mendatang = PeriodePKL::where('tgl_mulai', '>', Carbon::now())->select('id_periode')->first();
            $data_mhs = null;
            $total_mhs = 0;
            $total_dospem = DosenPembimbing::count();
            $data_mhs_menunggu_konfirmasi = null;


            if($periode_aktif != null){
                $data_mhs = Mahasiswa::selectRaw('status, count(*) as jumlah')
                ->groupBy('status')
                ->whereRaw("periode_pkl = '$periode_aktif->id_periode' OR periode_pkl IS NULL")
                ->get()
                ->pluck('jumlah', 'status');

                $data_mhs_menunggu_konfirmasi = PKL::selectRaw('pkl.status, count(*) as jumlah')
                ->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')
                ->whereRaw("pkl.status NOT IN ('Aktif', 'Praregistrasi')")
                ->groupBy('pkl.status')
                ->get()
                ->pluck('jumlah', 'status');

                $data_mhs_menunggu_konfirmasi_seminar = SeminarPKL::selectRaw('seminar_pkl.status, count(*) as jumlah')
                ->join('mahasiswa', 'seminar_pkl.nim', '=', 'mahasiswa.nim')
                ->whereRaw("seminar_pkl.status = 'Pengajuan'")
                ->groupBy('seminar_pkl.status')
                ->get()
                ->pluck('jumlah', 'status');

                $data_mhs_menunggu_konfirmasi = $data_mhs_menunggu_konfirmasi->merge($data_mhs_menunggu_konfirmasi_seminar);

                $total_mhs = $data_mhs->sum();
            }
            $mhs_blm_punya_pembimbing = Mahasiswa::whereNull('id_dospem')->count();
            $mhs_sdh_punya_pembimbing = $total_mhs - $mhs_blm_punya_pembimbing;

            return view('koordinator.dashboard', [
                'periode_aktif' => $periode_aktif,
                'periode_mendatang' => $periode_mendatang,
                'data_mhs' => $data_mhs,
                'total_mhs' => $total_mhs,
                'total_dospem' => $total_dospem,
                'mhs_blm_punya_pembimbing' => $mhs_blm_punya_pembimbing,
                'mhs_sdh_punya_pembimbing' => $mhs_sdh_punya_pembimbing,
                'data_mhs_menunggu_konfirmasi' => $data_mhs_menunggu_konfirmasi,
            ]);
        } else {
            $user = auth()->user();
            $mahasiswa = $user->mahasiswa;

            return view('mahasiswa.dashboard', [
                'user' => $user,
                'mahasiswa' => $mahasiswa,
                'pkl' => $mahasiswa->pkl,
                'created_at' => Carbon::parse($user->created_at)->diffForHumans(),
                'data_pengumuman' => Pengumuman::get_data_pengumuman(),
                'data_dokumen' => Dokumen::get_data_dokumen(),
            ]);
        }
    }

    public function tutup_pesan()
    {
        session()->forget('buka_pesan');
        return response()->json(['success' => 'Pesan berhasil ditutup']);
    }

    public function praregistrasi()
    {
        return view('mahasiswa.praregistrasi');
    }

    public function submit_praregistrasi(Request $request)
    {
        $user = auth()->user();
        request()->no_wa = str_replace(['+', ' ', '_'], '', $request->no_wa);
        $request->merge(['no_wa' => request()->no_wa]);
        $request->validate([
            'email' => 'required|unique:mahasiswa|regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
            // 'no_wa' => 'required|max:20|regex:/^[0-9]{1,20}$/',
            'no_wa' => 'required|min:6|unique:mahasiswa',
            'password' => 'required|min:8|max:32|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'konfirmasi_password' => 'required|same:password',
            'instansi' => 'required',
            'judul' => 'required',
        ], [
            'email.required' => 'Alamat email harus diisi',
            'email.regex' => 'Format alamat email tidak valid',
            'email.unique' => 'Alamat email sudah digunakan',
            'no_wa.required' => 'Nomor Whatsapp harus diisi',
            'no_wa.min' => 'Nomor Whatsapp terlalu pendek',
            'no_wa.unique' => 'Nomor Whatsapp sudah digunakan',
            'password.required' => 'Password baru harus diisi',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.max' => 'Password baru maksimal 32 karakter',
            'password.regex' => 'Password baru harus mengandung huruf dan angka',
            'konfirmasi_password.required' => 'Konfirmasi password baru harus diisi',
            'konfirmasi_password.same' => 'Konfirmasi password baru tidak sesuai',
            'instansi.required' => 'Instansi harus diisi',
            'judul.required' => 'Judul PKL harus diisi',
        ]);

        Mahasiswa::praregistrasi($request->email, $request->no_wa);
        PKL::praregistrasi($user->username, $request->instansi, $request->judul);
        $user->update_password($request->password);

        return redirect('/dashboard')->with('success', 'Data berhasil diperbarui. Selamat Datang di SIPKL Informatika Undip!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
