<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PKL extends Model
{
    use HasFactory;

    protected $table = 'pkl';
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    // Relasi antar tabel
    public function mahasiswa(){
        return $this->hasOne(Mahasiswa::class,'nim','nim');
    }

    public function getRouteKeyName(){
        return 'nim';
    }

    public static function get_data_reg_pkl(){
        $data_pkl = self::whereRaw("pkl.status = 'Registrasi'")
        ->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')
        ->leftJoin('dosen_pembimbing', 'mahasiswa.id_dospem', '=', 'dosen_pembimbing.id')
        ->select('mahasiswa.*', 'pkl.*', 'dosen_pembimbing.nama as nama_dospem')
        ->get();

        return $data_pkl;
    }

    public static function terima_registrasi($pkl, $periode_pkl){
        $pkl->status = 'Aktif';
        $pkl->pesan = null;
        $pkl->save();

        Mahasiswa::set_periode($pkl->nim, $periode_pkl->id_periode);
    }

    public static function tolak_registrasi($pkl, $alasan_menolak){
        $pkl->status = 'Praregistrasi';
        $pkl->pesan = $alasan_menolak;
        $pkl->save();
    }

    public static function bulk_reset_pkl_mhs($arr_nim){
        self::whereIn('nim', $arr_nim)->update(['status' => 'Praregistrasi']);
    }

    public static function get_data_laporan_pkl(){
        $data_laporan = PKL::whereRaw("pkl.status = 'Laporan'")->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')->get();

        return $data_laporan;
    }

    public static function get_data_pkl_selesai(){
        $data_mhs = PKL::whereRaw("pkl.status = 'Selesai'")->join('mahasiswa', 'pkl.nim', '=', 'mahasiswa.nim')->get();

        return $data_mhs;
    }

    public static function terima_laporan($pkl){
        $pkl->status = 'Selesai';
        $pkl->pesan = null;
        $pkl->tgl_verif_laporan = now();
        $pkl->save();
    
        Mahasiswa::set_status($pkl->nim, 'Lulus');
    }

    public static function tolak_laporan($pkl, $alasan_menolak){
        $pkl->status = 'Aktif';
        $pkl->pesan = $alasan_menolak;
        $pkl->save();
    }

    public static function assign_nilai($pkl, $nilai){
        ArsipPKL::create([
            'nim' => $pkl->nim,
            'nama' => $pkl->mahasiswa->nama,
            'instansi' => $pkl->instansi,
            'judul' => $pkl->judul,
            'abstrak' => $pkl->abstrak,
            'keyword1' => $pkl->keyword1,
            'keyword2' => $pkl->keyword2,
            'keyword3' => $pkl->keyword3,
            'keyword4' => $pkl->keyword4,
            'keyword5' => $pkl->keyword5,
            'link_laporan' => $pkl->link_laporan,
            'tgl_verif_laporan' => $pkl->tgl_verif_laporan,
            'nilai' => $nilai,
            'periode_pkl' => $pkl->mahasiswa->periode_pkl,
        ]);
    
        RiwayatPKL::create([
            'nim' => $pkl->nim,
            'periode_pkl' => $pkl->mahasiswa->periode_pkl,
            'status' => 'Lulus',
            'id_dospem' => $pkl->mahasiswa->id_dospem,
            'nilai' => $nilai,
        ]);
    
        if ($pkl->scan_irs != null){
            Storage::delete($pkl->scan_irs);
        }
        
        $pkl->delete();
    
        $seminar_pkl = SeminarPKL::where('nim', $pkl->nim)->first();
    
        if ($seminar_pkl){
        if ($seminar_pkl->scan_layak_seminar != null){
            Storage::delete($seminar_pkl->scan_layak_seminar);
        }
        if($seminar_pkl->scan_peminjaman_ruang != null){
            Storage::delete($seminar_pkl->scan_peminjaman_ruang);
        }
            $seminar_pkl->delete();
        }
    }
}
