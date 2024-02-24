<?php

namespace App\Models;

use App\Imports\JadwalSeminarImport;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarPKL extends Model
{
    use HasFactory;

    protected $table = 'seminar_pkl';
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
    protected $guarded = [];

    // Relasi antar tabel
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class,'nim','nim');
    }

    public function dosen_pembimbing()
    {
        return $this->hasOne(DosenPembimbing::class,'id','id_dospem');
    }

    static public function get_data_pengajuan(){
        $data_pengajuan = self::whereRaw('seminar_pkl.status = "Pengajuan" AND pesan is NULL')
        ->join('mahasiswa', 'seminar_pkl.nim', '=', 'mahasiswa.nim')
        ->leftJoin('dosen_pembimbing', 'seminar_pkl.id_dospem', '=', 'dosen_pembimbing.id')
        ->select('seminar_pkl.*', 'mahasiswa.nama as nama_mhs', 'dosen_pembimbing.nama as nama_dospem')
        ->get();

        return $data_pengajuan;
    }

    public static function terima_pengajuan($seminar_pkl){
        $seminar_pkl->update([
            'status' => 'Tak Terjadwal'
        ]);
    }

    public static function tolak_pengajuan($seminar_pkl){
        $seminar_pkl->update([
            'status' => 'Pengajuan',
            'pesan' => request('alasan_menolak'),
        ]);
    }

    public static function get_data_jadwal(){
        $data_jadwal = self::whereRaw('seminar_pkl.status = "Tak Terjadwal" OR seminar_pkl.status = "Terjadwal"')
        ->join('mahasiswa', 'seminar_pkl.nim', '=', 'mahasiswa.nim')
        ->leftJoin('dosen_pembimbing', 'seminar_pkl.id_dospem', '=', 'dosen_pembimbing.id')
        ->select('seminar_pkl.*', 'mahasiswa.nama as nama_mhs', 'dosen_pembimbing.nama as nama_dospem')
        ->get();

        return $data_jadwal;
    }

    public static function tambah_jadwal_seminar($request){
        $arr_mhs = $request->arr_mhs;
        $data = [];
        foreach ($arr_mhs as $mhs) {
        $data[] = [
            'nim' => $mhs[0],
            'tgl_seminar' => $request->tgl_seminar,
            'waktu_seminar' => $request->waktu_seminar,
            'ruang' => $request->ruang,
            'status' => 'Terjadwal',
            'id_dospem' => $mhs[1],
            ];
        }

        SeminarPKL::insert($data);
    }

    public static function import_jadwal_seminar($file){
        $import = new JadwalSeminarImport;
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
}
