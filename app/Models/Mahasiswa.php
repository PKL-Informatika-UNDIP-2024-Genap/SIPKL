<?php

namespace App\Models;

use App\Imports\MahasiswaImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    // Relasi antar tabel
    public function dosen_pembimbing(){
        return $this->hasOne(DosenPembimbing::class,'id','id_dospem');
    }

    public function pkl(){
        return $this->hasOne(PKL::class,'nim','nim');
    }

    public function seminar_pkl(){
        return $this->hasOne(SeminarPKL::class,'nim','nim');
    }

    public function riwayat_pkl(){
        return $this->hasOne(RiwayatPKL::class,'nim','nim');
    }

    public static function import($file){
        $import = new MahasiswaImport;
        $import->import($file);

        $error_row = [];
        $error_message = [];
        foreach ($import->failures() as $failure) {
            array_push($error_row, $failure->row());
            array_push($error_message, $failure->errors());
        }

        return [
            'error_row' => $error_row,
            'error_message' => $error_message,
        ];
    }

    // Get Mahasiswa with or without dospem
    public static function get_mhs_wwo_dospem($id_dospem){
        $data_mhs = self::whereRaw("(id_dospem = '$id_dospem' OR id_dospem IS NULL) AND (mahasiswa.status = 'Aktif' OR mahasiswa.status = 'Nonaktif')")
        ->join('pkl', 'mahasiswa.nim', '=', 'pkl.nim')
        ->select('mahasiswa.*', 'pkl.instansi', 'pkl.judul')
        ->get();

        return $data_mhs;
    }

    public static function get_mhs_by_dospem_periode($id_dospem, $periode_pkl){
        if($periode_pkl == ''){
            $arr_mhs = self::whereRaw("id_dospem = $id_dospem")->join('pkl', 'mahasiswa.nim', '=', 'pkl.nim')
            ->select('mahasiswa.*', 'pkl.instansi', 'pkl.judul')
            ->get();
        }else if($periode_pkl == "belum"){
            $arr_mhs = self::whereRaw("id_dospem = $id_dospem AND periode_pkl IS NULL")->join('pkl', 'mahasiswa.nim', '=', 'pkl.nim')
            ->select('mahasiswa.*', 'pkl.instansi', 'pkl.judul')
            ->get();
        } else {
            $arr_mhs = self::whereRaw("id_dospem = $id_dospem AND periode_pkl = '$periode_pkl'")->with(['pkl'])->join('pkl', 'mahasiswa.nim', '=', 'pkl.nim')
            ->select('mahasiswa.*', 'pkl.instansi', 'pkl.judul')
            ->get();
        }

        return $arr_mhs;
    }

    public static function get_mhs_blm_selesai(){
        $arr_mhs = self::join('periode_pkl', 'periode_pkl.id_periode', '=', 'mahasiswa.periode_pkl')
        ->where("tgl_selesai", "<", date('Y-m-d'))
        ->whereRaw("mahasiswa.status = 'Aktif' OR mahasiswa.status = 'Nonaktif'")
        ->leftJoin("dosen_pembimbing", "dosen_pembimbing.id", "=", "mahasiswa.id_dospem")
        ->leftJoin("pkl", "pkl.nim", "=", "mahasiswa.nim")
        ->select('mahasiswa.*', 'dosen_pembimbing.nama as nama_dospem', 'pkl.judul', 'pkl.instansi', 'pkl.status as status_pkl')
        ->get();

        return $arr_mhs;
    }

    public static function get_mhs_with_pkl_dospem(){
        $data_mhs = self::select('mahasiswa.nim', 'mahasiswa.nama', 'mahasiswa.status', 'mahasiswa.id_dospem', 'dosen_pembimbing.nama as nama_dospem', 'pkl.instansi', 'pkl.judul')
        ->whereRaw("mahasiswa.status = 'Nonaktif' OR mahasiswa.status = 'Aktif'")
        ->leftJoin('dosen_pembimbing', 'dosen_pembimbing.id', '=', 'mahasiswa.id_dospem')
        ->leftJoin('pkl', 'pkl.nim', '=', 'mahasiswa.nim')
        ->get();

        return $data_mhs;
    }

    public static function get_mhs_aktif_blm_seminar(){
        $mhs_aktif = Mahasiswa::where('mahasiswa.status', 'Aktif')
        ->whereNotIn('mahasiswa.nim', function($query) {
            $query->select('seminar_pkl.nim')->from('seminar_pkl');
        })
        ->leftJoin('dosen_pembimbing', 'mahasiswa.id_dospem', '=', 'dosen_pembimbing.id')
        ->leftJoin('pkl', 'mahasiswa.nim', '=', 'pkl.nim')
        ->select('mahasiswa.nim', 'mahasiswa.nama', 'mahasiswa.id_dospem', 'dosen_pembimbing.nama as nama_dospem', 'pkl.judul', 'pkl.instansi')
        ->get();
        
        return $mhs_aktif;
    }

    public static function set_dospem($nim, $id_dospem){
        self::where('nim', $nim)->update([
            'id_dospem' => $id_dospem,
        ]);
    }

    public static function set_periode($nim, $id_periode){
        self::where('nim', $nim)->update([
            'status' => 'Aktif',
            'periode_pkl' => $id_periode,
        ]);
    }
    
    public static function set_status($nim, $status){
        self::where('nim', $nim)->update([
            'status' => $status,
        ]);
    }

    public static function bulk_update_dospem_mhs($id_dospem, $arr_nim_add_mhs, $arr_nim_delete_mhs){
        if (!empty($arr_nim_add_mhs)) {
            self::whereIn('nim', $arr_nim_add_mhs)->update(['id_dospem' => $id_dospem]);
        }

        if (!empty($arr_nim_delete_mhs)) {
            self::whereIn('nim', $arr_nim_delete_mhs)->update(['id_dospem' => null]);
        }
    }

    public static function reset_status_mhs_blm_selesai($arr_nim){
        $arr_mhs = self::whereIn('nim', $arr_nim);
        RiwayatPKL::bulk_create($arr_mhs);
        
        $arr_mhs->update(['status' => 'Nonaktif']);

        PKL::bulk_reset_pkl_mhs($arr_nim);
    }
    


}
