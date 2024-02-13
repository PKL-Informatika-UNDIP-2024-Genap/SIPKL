<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = [
            [
                'nim' => '24060121130086',
                'nama' => 'Muhammad Rizki',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121130050',
                'nama' => 'Rizki Utama Fauzi',
            ],
            [
                'nim' => '24060121130123',
                'nama' => 'Budi Santoso',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 5,
            ],
            [
                'nim' => '24060121130234',
                'nama' => 'Siti Nurul Hidayah',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060121130345',
                'nama' => 'Agus Setiawan',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060121130456',
                'nama' => 'Linda Pratiwi',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060121130567',
                'nama' => 'Adi Wijaya',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121130678',
                'nama' => 'Dewi Anggraeni',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121130789',
                'nama' => 'Hendro Wibowo',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121130890',
                'nama' => 'Rina Fitriani',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121130901',
                'nama' => 'Yoga Prasetyo',
                'status' => 'Nonaktif',
            ],
            [
                'nim' => '24060121131012',
                'nama' => 'Ayu Kartika',
                'status' => 'Lulus',
                'periode_pkl' => '2023/2024 Ganjil',
                'id_dospem' => 2,
            ],
            [
                'nim' => '24060121131123',
                'nama' => 'Rudi Hartono',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060121131234',
                'nama' => 'Eka Putri',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060121131345',
                'nama' => 'Irfan Pratama',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060121131456',
                'nama' => 'Siti Rahayu',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060120150001', // NIM Mahasiswa 16
                'nama' => 'Diana Sari',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060120150002', // NIM Mahasiswa 17
                'nama' => 'Ahmad Fauzi',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060120150003', // NIM Mahasiswa 18
                'nama' => 'Fitriani Hidayati',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060120150004', // NIM Mahasiswa 19
                'nama' => 'Agung Setiawan',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060120150005', // NIM Mahasiswa 20
                'nama' => 'Ratna Dewi',
                'status' => 'Aktif',
                'periode_pkl' => '2023/2024 Genap',
            ],
            [
                'nim' => '24060120150006', // NIM Mahasiswa 21
                'nama' => 'Hendra Wijaya',
            ],
            [
                'nim' => '24060120150007', // NIM Mahasiswa 22
                'nama' => 'Rini Fitria',
            ],
            [
                'nim' => '24060120150008', // NIM Mahasiswa 23
                'nama' => 'Arief Prasetyo',
            ],
            [
                'nim' => '24060120150009', // NIM Mahasiswa 24
                'nama' => 'Lia Kartika',
            ],
            [
                'nim' => '24060120150010', // NIM Mahasiswa 25
                'nama' => 'Firman Nugroho',
            ],
            [
                'nim' => '24060120150011', // NIM Mahasiswa 26
                'nama' => 'Eka Widiastuti',
            ],
            [
                'nim' => '24060120150012', // NIM Mahasiswa 27
                'nama' => 'Dwi Cahyono',
            ],
            [
                'nim' => '24060120150013', // NIM Mahasiswa 28
                'nama' => 'Ratih Susanti',
            ],
            [
                'nim' => '24060120150014', // NIM Mahasiswa 29
                'nama' => 'Aditya Saputra',
            ],
            [
                'nim' => '24060120150015', // NIM Mahasiswa 30
                'nama' => 'Sri Wahyuni',
            ],
        ];

        foreach ($mahasiswa as $mhs) {
            \App\Models\Mahasiswa::create($mhs);
        }
    }
}
