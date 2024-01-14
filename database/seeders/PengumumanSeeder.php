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
            // 'tanggal' => '2024-01-01'
        ]);
        Pengumuman::create([
            'id' => '2',
            'deskripsi' => 'Distribusi Pembimbing PKL Ganjil 2023/2024',
            // 'tanggal' => '2024-01-04'
        ]);
        Pengumuman::create([
            'id' => '3',
            'deskripsi' => 'Data Instansi PKL Terdahulu',
            // 'tanggal' => '2024-01-08'
        ]);
        Pengumuman::create([
            'id' => '4',
            'deskripsi' => 'Distribusi Awal PKL Genap 2023/2024',
            // 'tanggal' => '2024-01-14'
        ]);

    }
}
