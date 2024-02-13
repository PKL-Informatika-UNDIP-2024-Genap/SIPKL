<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeminarPKLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seminar_pkl = [
            [
                'nim' => '24060121130086',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2021-08-01',
                'waktu_seminar' => '08:00-10:00',
                'ruang' => 'A101',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.pdf',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.pdf',
            ],
            [
                'nim' => '24060121131012',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2021-08-01',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'A101',
                'id_dospem' => 2,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.pdf',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.pdf',
            ],
            [
                'nim' => '24060121130123',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2021-08-01',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'A101',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.pdf',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.pdf',
            ],
            [
                'nim' => '24060121130234',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2021-08-01',
                'waktu_seminar' => '08:00-10:00',
                'ruang' => 'A101',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.pdf',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.pdf',
            ],
            [
                'nim' => '24060121130345',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2021-08-01',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'A101',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.pdf',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.pdf',
            ],
            [
                'nim' => '24060121130456',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2021-08-01',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'A101',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.pdf',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.pdf',
            ],
            [
                'nim' => '24060121130567',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2021-08-01',
                'waktu_seminar' => '15:00-17:00',
                'ruang' => 'A101',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.pdf',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.pdf',
            ],
            
        ];

        foreach ($seminar_pkl as $seminar) {
            \App\Models\SeminarPKL::create($seminar);
        }
    }
}
