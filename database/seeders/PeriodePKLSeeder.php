<?php

namespace Database\Seeders;

use App\Models\PeriodePKL;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodePKLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PeriodePKL::create([
            'id' => 1,
            'tgl_mulai' => '2022-01-01',
            'tgl_selesai' => '2022-08-15',
            'status' => 'aktif',
        ]);
        PeriodePKL::create([
            'id' => 2,
            'tgl_mulai' => '2022-08-01',
            'tgl_selesai' => '2023-01-15',
            'status' => 'aktif',
        ]);
        PeriodePKL::create([
            'id' => 3,
            'tgl_mulai' => '2023-01-01',
            'tgl_selesai' => '2023-08-15',
            'status' => 'aktif',
        ]);
        PeriodePKL::create([
            'id' => 4,
            'tgl_mulai' => '2023-08-01',
            'tgl_selesai' => '2024-01-15',
            'status' => 'aktif',
        ]);
        PeriodePKL::create([
            'id' => 5,
            'tgl_mulai' => '2024-01-01',
            'tgl_selesai' => '2024-08-15',
            'status' => 'aktif',
        ]);
    }
}
