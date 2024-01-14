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
        ]);
        Dokumen::create([
            'id' => '2',
            'deskripsi' => 'Surat Pengantar Perizinan PKL',
        ]);
        Dokumen::create([
            'id' => '3',
            'deskripsi' => 'Form Layak Seminar PKL',
        ]);
        Dokumen::create([
            'id' => '4',
            'deskripsi' => 'Form Permohonan Mengundang Seminar PKL',
        ]);
        Dokumen::create([
            'id' => '5',
            'deskripsi' => 'Form Berita Acara Seminar PKL',
        ]);
        Dokumen::create([
            'id' => '6',
            'deskripsi' => 'Form Penilaian Dosen',
        ]);
        Dokumen::create([
            'id' => '7',
            'deskripsi' => 'Form Penilaian Penyelia/Instansi',
        ]);
        Dokumen::create([
            'id' => '8',
            'deskripsi' => 'Form Peminjaman Laboratorium',
        ]);
        Dokumen::create([
            'id' => '9',
            'deskripsi' => 'Format Proposal PKL',
        ]);
        Dokumen::create([
            'id' => '10',
            'deskripsi' => 'Format Laporan PKL',
        ]);
    }
}
