<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MhsAktifExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
{
    use Exportable;
    public function query()
    {
        return Mahasiswa::query()->whereRaw("mahasiswa.status = 'Aktif' AND id_dospem is not null")
        ->whereNotIn('mahasiswa.nim', function($query) {
            $query->select('nim')->from('seminar_pkl');
        })
        ->join('dosen_pembimbing', 'mahasiswa.id_dospem', '=', 'dosen_pembimbing.id')
        ->join('pkl', 'mahasiswa.nim', '=', 'pkl.nim')
        ->orderBy('mahasiswa.id_dospem', 'asc')
        ->orderBy('pkl.judul', 'asc')
        ->orderBy('pkl.nim', 'asc')
        ->select('mahasiswa.id_dospem', 'dosen_pembimbing.nama as nama_dospem', 'mahasiswa.nim', 'mahasiswa.nama as nama_mhs', 'pkl.judul', 'pkl.instansi');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ['id_dospem', 'nama_dospem', 'nim', 'nama_mhs', 'judul_pkl', 'instansi', 'tgl_seminar', 'waktu_seminar', 'ruang'];
    }

    public function map($row): array
    {
        // Set default values for 'Tanggal Seminar' and 'Waktu Seminar'
        $defaultTanggalSeminar = 'yyyy-mm-dd';
        $defaultWaktuSeminar = '00:00-00:00';

        return [
            $row->id_dospem,
            $row->nama_dospem,
            $row->nim,
            $row->nama_mhs,
            $row->judul,
            $row->instansi,
            $defaultTanggalSeminar,
            $defaultWaktuSeminar,
            $row->ruang
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
