<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\PeriodePKL;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeriodePKLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PeriodePKL::create([
            'id_periode' => "2021/2022 Genap",
            'tgl_mulai' => Carbon::parse('2022-01-01'),
            'tgl_selesai' => Carbon::parse('2022-08-15'),
        ]);
        PeriodePKL::create([
            'id_periode' => "2022/2023 Ganjil",
            'tgl_mulai' => Carbon::parse('2022-08-01'),
            'tgl_selesai' => Carbon::parse('2023-01-15'),
        ]);
        PeriodePKL::create([
            'id_periode' => "2022/2023 Genap",
            'tgl_mulai' => Carbon::parse('2023-01-01'),
            'tgl_selesai' => Carbon::parse('2023-08-15'),
        ]);
        PeriodePKL::create([
            'id_periode' => "2023/2024 Ganjil",
            'tgl_mulai' => Carbon::parse('2023-08-01'),
            'tgl_selesai' => Carbon::parse('2024-01-15'),
        ]);
        PeriodePKL::create([
            'id_periode' => "2023/2024 Genap",
            'tgl_mulai' => Carbon::parse('2024-01-01'),
            'tgl_selesai' => Carbon::parse('2024-08-15'),
        ]);
        PeriodePKL::create([
            'id_periode' => "2024/2025 Ganjil",
            'tgl_mulai' => Carbon::parse('2024-08-01'),
            'tgl_selesai' => Carbon::parse('2025-01-15'),
        ]);
    }
}
