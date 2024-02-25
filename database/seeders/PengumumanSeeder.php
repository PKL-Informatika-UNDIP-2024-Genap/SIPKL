<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengumuman::create([
            'id' => '1',
            'deskripsi' => 'Registrasi PKL Ganjil 23/24',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2023-08-01 00:00:00',
            'updated_at' => '2023-08-01 00:00:00',
        ]);
        Pengumuman::create([
            'id' => '2',
            'deskripsi' => 'Distribusi Pembimbing PKL Ganjil 2023/2024',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2023-09-03 00:00:00',
            'updated_at' => '2023-09-03 00:00:00',
        ]);
        Pengumuman::create([
            'id' => '3',
            'deskripsi' => 'Data Instansi PKL Terdahulu',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2023-12-12 00:00:00',
            'updated_at' => '2023-12-12 00:00:00',
        ]);
        Pengumuman::create([
            'id' => '4',
            'deskripsi' => 'Distribusi Awal PKL Genap 2023/2024',
            'created_at' => '2024-01-10 00:00:00',
            'updated_at' => '2024-01-10 00:00:00',
        ]);

    }
}
