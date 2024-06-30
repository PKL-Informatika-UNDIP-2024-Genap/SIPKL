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
                'tgl_seminar' => '2024-06-01',
                'waktu_seminar' => '08:00-10:00',
                'ruang' => 'A101',
                'id_dospem' => 1,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],

            [
                'nim' => '24060121100031',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2024-06-01',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'A101',
                'id_dospem' => 1,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100032',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2024-04-02',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'B102',
                'id_dospem' => 1,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100033',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2024-04-03',
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'C103',
                'id_dospem' => 2,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100034',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2024-04-04',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'D104',
                'id_dospem' => 2,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100035',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2024-04-05',
                'waktu_seminar' => '11:00-13:00',
                'ruang' => 'E105',
                'id_dospem' => 3,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100036',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2024-04-06',
                'waktu_seminar' => '08:00-10:00',
                'ruang' => 'F106',
                'id_dospem' => 3,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100037',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2024-04-07',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'G107',
                'id_dospem' => 4,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100038',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2024-04-08',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'H108',
                'id_dospem' => 4,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100039',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2024-04-09',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'I109',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100040',
                'status' => 'Pengajuan',
                'tgl_seminar' => '2023-12-10', // tidak lulus periode sebelumnya
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'J110',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],

            [
                'nim' => '24060121100041',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-01',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'A101',
                'id_dospem' => 1,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100042',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-01',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'B102',
                'id_dospem' => 1,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100043',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-02',
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'C103',
                'id_dospem' => 2,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100044',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-02',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'D104',
                'id_dospem' => 2,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100045',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-03',
                'waktu_seminar' => '11:00-13:00',
                'ruang' => 'E105',
                'id_dospem' => 3,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100046',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-03',
                'waktu_seminar' => '08:00-10:00',
                'ruang' => 'F106',
                'id_dospem' => 3,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100047',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-04',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'G107',
                'id_dospem' => 4,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100048',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-04',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'H108',
                'id_dospem' => 4,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100049',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-05',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'I109',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100050',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-07-15',
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'J110',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],

            [
                'nim' => '24060121100051',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-10',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'A101',
                'id_dospem' => 6,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100052',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-10',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'B102',
                'id_dospem' => 6,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100053',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-11',
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'C103',
                'id_dospem' => 7,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100054',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-11',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'D104',
                'id_dospem' => 7,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100055',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-12',
                'waktu_seminar' => '11:00-13:00',
                'ruang' => 'E105',
                'id_dospem' => 8,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100056',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-12',
                'waktu_seminar' => '08:00-10:00',
                'ruang' => 'F106',
                'id_dospem' => 8,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100057',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-13',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'G107',
                'id_dospem' => 9,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100058',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-13',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'H108',
                'id_dospem' => 9,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100059',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-14',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'I109',
                'id_dospem' => 10,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100060',
                'status' => 'Terjadwal',
                'tgl_seminar' => '2024-07-14',
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'J110',
                'id_dospem' => 10,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],

            [
                'nim' => '24060121100061',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-01',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'A101',
                'id_dospem' => 1,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100062',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-01',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'B102',
                'id_dospem' => 2,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100063',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-02',
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'C103',
                'id_dospem' => 3,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100064',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-02',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'D104',
                'id_dospem' => 4,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100065',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-03',
                'waktu_seminar' => '11:00-13:00',
                'ruang' => 'E105',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100066',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-03',
                'waktu_seminar' => '08:00-10:00',
                'ruang' => 'F106',
                'id_dospem' => 6,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100067',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-04',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'G107',
                'id_dospem' => 7,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100068',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-04',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'H108',
                'id_dospem' => 8,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100069',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-05',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'I109',
                'id_dospem' => 9,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100070',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-06-05',
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'J110',
                'id_dospem' => 10,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],

            [
                'nim' => '24060121100071',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-20',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'A101',
                'id_dospem' => 1,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100072',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-20',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'B102',
                'id_dospem' => 2,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100073',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-21',
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'C103',
                'id_dospem' => 3,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100074',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-21',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'D104',
                'id_dospem' => 4,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100075',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-22',
                'waktu_seminar' => '11:00-13:00',
                'ruang' => 'E105',
                'id_dospem' => 5,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100076',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-22',
                'waktu_seminar' => '08:00-10:00',
                'ruang' => 'F106',
                'id_dospem' => 6,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100077',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-23',
                'waktu_seminar' => '13:00-15:00',
                'ruang' => 'G107',
                'id_dospem' => 7,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100078',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-23',
                'waktu_seminar' => '10:00-12:00',
                'ruang' => 'H108',
                'id_dospem' => 8,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100079',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-24',
                'waktu_seminar' => '14:00-16:00',
                'ruang' => 'I109',
                'id_dospem' => 9,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            [
                'nim' => '24060121100080',
                'status' => 'Tak Terjadwal',
                'tgl_seminar' => '2024-03-24',
                'waktu_seminar' => '09:00-11:00',
                'ruang' => 'J110',
                'id_dospem' => 10,
                'scan_layak_seminar' => '/private/scan_layak_seminar/template_scan.jpg',
                'scan_peminjaman_ruang' => '/private/scan_peminjaman_ruang/template_scan.jpg',
            ],
            
            
        ];

        foreach ($seminar_pkl as $seminar) {
            \App\Models\SeminarPKL::create($seminar);
        }
    }
}
