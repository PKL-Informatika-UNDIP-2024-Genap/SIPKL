<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPembimbing extends Model
{
    use HasFactory;

    protected $table = 'dosen_pembimbing';
    // protected $primaryKey = 'id';
    // protected $keyType = 'int';
    // public $incrementing = true;
    public $timestamps = false;
    protected $guarded = [];

    public static function count_bimbingan_aktif_per_dospem(){
        $data_dospem = self::leftJoin('mahasiswa', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
        ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, 
                    COUNT(CASE WHEN mahasiswa.status = "Aktif" OR mahasiswa.status = "Nonaktif" THEN mahasiswa.id_dospem ELSE NULL END) as jumlah_bimbingan')
        ->groupBy('dosen_pembimbing.id','dosen_pembimbing.nip', 'dosen_pembimbing.nama')
        ->get();

        return $data_dospem;
    }

    public static function count_bimbingan_per_dospem($periode_pkl, $arr_periode){
        if($periode_pkl == ''){
            $data_dospem = self::whereIn('periode_pkl', $arr_periode)
            ->orWhereNull('periode_pkl')
            ->leftJoin('mahasiswa', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
            ->groupBy('dosen_pembimbing.id', 'dosen_pembimbing.nip', 'dosen_pembimbing.nama')
            ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, count(mahasiswa.id_dospem) as jml_bimbingan')
            ->get();
        }else if($periode_pkl == "belum"){
            $data_dospem = self::leftJoin('mahasiswa', function($join) use ($periode_pkl) {
                $join->on('dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
                     ->whereNull('mahasiswa.periode_pkl');
            })
            ->groupBy('dosen_pembimbing.id', 'dosen_pembimbing.nip', 'dosen_pembimbing.nama')
            ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, COUNT(mahasiswa.id_dospem) as jml_bimbingan')
            ->get();
        } else {
            $data_dospem = self::leftJoin('mahasiswa', function($join) use ($periode_pkl) {
                $join->on('dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
                     ->where('mahasiswa.periode_pkl', '=', $periode_pkl);
            })
            ->groupBy('dosen_pembimbing.id', 'dosen_pembimbing.nip', 'dosen_pembimbing.nama')
            ->selectRaw('dosen_pembimbing.id, dosen_pembimbing.nip, dosen_pembimbing.nama, COUNT(mahasiswa.id_dospem) as jml_bimbingan')
            ->get();
        }

        return $data_dospem;

    }

    public static function get_nama_nip_by_id($id){
        return self::select('nama', 'nip')->where('id', $id)->first();
    }
}
