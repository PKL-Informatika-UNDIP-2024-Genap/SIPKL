<?php

namespace Database\Seeders;

use App\Models\PKL;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PKLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pkl = [
            [
                'nim' => '24060121130086',
                'status' => 'Registrasi',
                'instansi' => 'PT. ABC',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130050',
                'status' => 'Registrasi',
                'instansi' => 'PT. DEF',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130123',
                'status' => 'Registrasi',
                'instansi' => 'PT. GHI',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130234',
                'status' => 'Registrasi',
                'instansi' => 'PT. JKL',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130345',
                'status' => 'Registrasi',
                'instansi' => 'PT. MNO',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130456',
                'status' => 'Registrasi',
                'instansi' => 'PT. PQR',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130567',
                'status' => 'Registrasi',
                'instansi' => 'PT. STU',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130678',
                'status' => 'Registrasi',
                'instansi' => 'PT. VWX',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130789',
                'status' => 'Registrasi',
                'instansi' => 'PT. YZA',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130890',
                'status' => 'Registrasi',
                'instansi' => 'PT. BCD',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121130901',
                'status' => 'Registrasi',
                'instansi' => 'PT. EFG',
                'judul' => 'Pengembangan Sistem Informasi',
                'scan_irs' => '/private/scan_irs/irs5.pdf',
                'tgl_registrasi' => '2024-01-01',
            ],
            [
                'nim' => '24060121131012',
                'status' => 'Praregistrasi',
                'instansi' => 'PT. HIJ',
                'judul' => 'Pengembangan Sistem Informasi',
            ],
            [
                'nim' => '24060121131123',
                'status' => 'Praregistrasi',
                'instansi' => 'PT. KLM',
                'judul' => 'Pengembangan Sistem Informasi',
            ],
            [
                'nim' => '24060121131234',
                'status' => 'Praregistrasi',
                'instansi' => 'PT. NOP',
                'judul' => 'Pengembangan Sistem Informasi',
            ],
            [
                'nim' => '24060121131345',
                'status' => 'Praregistrasi',
                'instansi' => 'PT. QRS',
                'judul' => 'Pengembangan Sistem Informasi',
            ]
        ];

        foreach ($pkl as $data) {
            PKL::create($data);
        }
    }
}
