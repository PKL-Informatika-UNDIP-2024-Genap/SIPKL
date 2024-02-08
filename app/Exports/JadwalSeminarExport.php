<?php

namespace App\Exports;

use App\Models\SeminarPKL;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JadwalSeminarExport implements FromQuery, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public $jenis_seminar = '';
    public function __construct($jenis_seminar)
    {
        $this->jenis_seminar = $jenis_seminar;
    }

    public function query()
    {
        if($this->jenis_seminar == '') {
            return SeminarPKL::query()->whereRaw("seminar_pkl.status = 'Tak Terjadwal' OR seminar_pkl.status = 'Terjadwal'")
            ->join('mahasiswa', 'seminar_pkl.nim', '=', 'mahasiswa.nim')
            ->join('dosen_pembimbing', 'seminar_pkl.id_dospem', '=', 'dosen_pembimbing.id')
            ->select('dosen_pembimbing.nama as dospem', 'tgl_seminar', 'waktu_seminar', 'ruang', 'mahasiswa.nama as nama_mhs', 'mahasiswa.nim', 'seminar_pkl.status');
        } else {
            return SeminarPKL::query()->whereRaw("seminar_pkl.status = '$this->jenis_seminar'")
            ->join('mahasiswa', 'seminar_pkl.nim', '=', 'mahasiswa.nim')
            ->join('dosen_pembimbing', 'seminar_pkl.id_dospem', '=', 'dosen_pembimbing.id')
            ->select('dosen_pembimbing.nama as dospem', 'tgl_seminar', 'waktu_seminar', 'ruang', 'mahasiswa.nama as nama_mhs', 'mahasiswa.nim', 'seminar_pkl.status');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Dosen Pembimbing", 'Tanggal', 'Waktu', 'Ruang', 'Nama Mahasiswa', 'NIM', 'Jenis'];
    }
}
