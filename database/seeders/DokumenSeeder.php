<?php

namespace Database\Seeders;

use App\Models\Dokumen;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dokumen::create([
            'id' => '1',
            'deskripsi' => 'Form Pernyataan Pengambilan PKL',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2023-08-01 00:00:00',
            'updated_at' => '2023-08-01 00:00:00',
        ]);
        Dokumen::create([
            'id' => '2',
            'deskripsi' => 'Surat Pengantar Perizinan PKL',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2023-09-03 00:00:00',
            'updated_at' => '2023-09-03 00:00:00',
        ]);
        Dokumen::create([
            'id' => '3',
            'deskripsi' => 'Form Layak Seminar PKL',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2023-12-12 00:00:00',
            'updated_at' => '2023-12-12 00:00:00',
        ]);
        Dokumen::create([
            'id' => '4',
            'deskripsi' => 'Form Permohonan Mengundang Seminar PKL',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2024-01-10 00:00:00',
            'updated_at' => '2024-01-10 00:00:00',
        ]);
        Dokumen::create([
            'id' => '5',
            'deskripsi' => 'Form Berita Acara Seminar PKL',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2024-01-15 00:00:00',
            'updated_at' => '2024-01-15 00:00:00',
        ]);
        Dokumen::create([
            'id' => '6',
            'deskripsi' => 'Form Penilaian Dosen',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2024-01-20 00:00:00',
            'updated_at' => '2024-01-20 00:00:00',
        ]);
        Dokumen::create([
            'id' => '7',
            'deskripsi' => 'Form Penilaian Penyelia/Instansi',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2024-01-25 00:00:00',
            'updated_at' => '2024-01-25 00:00:00',
        ]);
        Dokumen::create([
            'id' => '8',
            'deskripsi' => 'Form Peminjaman Laboratorium',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2024-02-01 00:00:00',
            'updated_at' => '2024-02-01 00:00:00',
        ]);
        Dokumen::create([
            'id' => '9',
            'deskripsi' => 'Format Proposal PKL',
            'lampiran' => 'https://drive.google.com',
            'created_at' => '2024-02-10 00:00:00',
            'updated_at' => '2024-02-10 00:00:00',
        ]);
        Dokumen::create([
            'id' => '10',
            'deskripsi' => 'Format Laporan PKL',
            'created_at' => '2024-02-15 00:00:00',
            'updated_at' => '2024-02-15 00:00:00',
        ]);
    }
}
