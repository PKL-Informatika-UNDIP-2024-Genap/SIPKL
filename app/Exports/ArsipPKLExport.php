<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ArsipPKLExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    use Exportable;
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function map($row): array
    {
        return [
            $row['nim'],
            $row['nama'],
            $row['periode_pkl'],
            $row['nilai'],
        ];
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama',
            'Periode PKL',
            'Nilai',
        ];
    }
}

