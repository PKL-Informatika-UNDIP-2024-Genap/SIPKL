<?php

namespace App\Exports;

use App\Models\CetakSK;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;

class SKExport implements FromView, WithColumnWidths, ShouldAutoSize, WithStyles, WithDefaultStyles, WithEvents
{
    use Exportable;

    public $data_sk;
    public $counter;

    public function __construct($status = "Belum", $tgl_mulai = null, $tgl_selesai = null)
    {
        $data_sk = CetakSK::select('dosen_pembimbing.id as id_dospem' ,'dosen_pembimbing.nama as nama_dospem', 'dosen_pembimbing.nip as nip_dospem', 'dosen_pembimbing.golongan as gol_dospem', 'dosen_pembimbing.jabatan as jabatan_dospem', 'cetak_sk.nama as nama_mhs', 'cetak_sk.nim as nim_mhs', 'judul as judul_pkl')->join('dosen_pembimbing', 'cetak_sk.id_dospem', '=', 'dosen_pembimbing.id')->where('status', $status);
        if ($status == "Sudah") {
            $data_sk = $data_sk->where("tgl_mulai", $tgl_mulai)->where("tgl_selesai", $tgl_selesai);
        }
        $data_sk = $data_sk->get();
        $data_sk = $data_sk->sortBy('nama_dospem');
        $counter = $data_sk->groupBy('id_dospem')->map->count()->values();
        $this->data_sk = $data_sk;
        $this->counter = $counter;

        if ($status == "Belum") {
            CetakSK::where('status', 'Belum')->update([
                'status' => 'Sudah',
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
            ]);
        }
    }
    
    public function view(): View
    {
        return view('koordinator.cetak_sk.export', [
            'data_sk' => $this->data_sk,
            'counter' => $this->counter,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            // 'A' => 5,
            'B' => 25,
            // 'C' => 20,
            // 'D' => 30,
            'E' => 70,
            // 'F' => 20,
        ];
    }

    public function styles($sheet)
    {
        return [
            2    => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ],
            ],
            'A' => [
                'alignment' => [
                    'horizontal' => 'center',
                    // 'vertical' => 'top',
                ],
            ],
            'F' => [
                'alignment' => [
                    'horizontal' => 'center',
                    // 'vertical' => 'top',
                ],
            ],
            
        ];
    }
    
    public function defaultStyles(Style $defaultStyle)
    {
        // $defaultStyle->getAlignment()->setHorizontal('top')->setVertical('top');
        return [
            'alignment' => [
                'horizontal' => 'top',
                'vertical' => 'top',
                'wrapText' => 'true',
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // get all cells in table
                $alphabet = 'F';
                $totalRow = (count($this->data_sk) + 2);
                $cellRange = 'A2:'.$alphabet.$totalRow;
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin',
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
