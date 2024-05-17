<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CetakSK extends Model
{
    use HasFactory;
    protected $table = 'cetak_sk';
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];


    public static function get_data_cetak_sk()
    {
        $data_sk = CetakSK::select('dosen_pembimbing.id as id_dospem' ,'dosen_pembimbing.nama as nama_dospem', 'dosen_pembimbing.nip as nip_dospem', 'dosen_pembimbing.golongan as gol_dospem', 'dosen_pembimbing.jabatan as jabatan_dospem', 'cetak_sk.nama as nama_mhs', 'cetak_sk.nim as nim_mhs', 'judul as judul_pkl', 'tgl_verif_laporan')->join('dosen_pembimbing', 'cetak_sk.id_dospem', '=', 'dosen_pembimbing.id')->where('status', 'Belum')->get();
        return $data_sk;
    }

    public static function get_data_riwayat_cetak_sk()
    {
        $data_sk = CetakSK::select('dosen_pembimbing.id as id_dospem' ,'dosen_pembimbing.nama as nama_dospem', 'dosen_pembimbing.nip as nip_dospem', 'dosen_pembimbing.golongan as gol_dospem', 'dosen_pembimbing.jabatan as jabatan_dospem', 'cetak_sk.nama as nama_mhs', 'cetak_sk.nim as nim_mhs', 'judul as judul_pkl', 'tgl_mulai', 'tgl_selesai')->join('dosen_pembimbing', 'cetak_sk.id_dospem', '=', 'dosen_pembimbing.id')->where('status', 'Sudah')->get();
        return $data_sk;
    }
}
