<?php

namespace App\Imports;

use App\Models\SeminarPKL;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class JadwalSeminarImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation, SkipsEmptyRows, SkipsOnFailure
{
    use Importable;
    use SkipsFailures;

    public function chunkSize(): int
    {
        return 50;
    }

    public function batchSize(): int
    {
        return 100;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row["id_dospem"] == null) {
            return null;
        } 
        return new SeminarPKL([
            "nim"=> $row["nim"],
            "id_dospem"=> $row["id_dospem"],
            "tgl_seminar"=> $row["tgl_seminar"],
            "waktu_seminar"=> $row["waktu_seminar"],
            "ruang"=> $row["ruang"],
            "status"=> "Terjadwal",
        ]);
    }

    public function rules(): array
    {
        return [
            'id_dospem' => 'required',
            'nim' => 'required|unique:seminar_pkl|max:25',
            'tgl_seminar' => 'required',
            'waktu_seminar' => 'required',
            'ruang' => 'required',
        ];
    }
}
