<?php

namespace Database\Seeders;

use App\Models\RiwayatPKL;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiwayatPKLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $riwayat_pkl = [
            [
                'nim' => '24060121130567',
                'periode_pkl' => '2023/2024 Ganjil',
                'status' => 'Tidak Lulus',
                'id_dospem' => 1,
                'nilai' => '',
            ],
            [
                'nim' => '24060121130567',
                'periode_pkl' => '2022/2023 Genap',
                'status' => 'Tidak Lulus',
                'id_dospem' => 1,
                'nilai' => '',
            ],

            [
                'nim' => '24060121130678',
                'periode_pkl' => '2023/2024 Ganjil',
                'status' => 'Tidak Lulus',
                'id_dospem' => 1,
                'nilai' => '',
            ],
            
            [
                'nim' => '24060120150004',
                'periode_pkl' => '2023/2024 Ganjil',
                'status' => 'Tidak Lulus',
                'id_dospem' => 1,
                'nilai' => '',
            ],
            [
                'nim' => '24060120150004',
                'periode_pkl' => '2022/2023 Genap',
                'status' => 'Tidak Lulus',
                'id_dospem' => 1,
                'nilai' => '',
            ],

            [
                'nim' => '24060121130345',
                'periode_pkl' => '2023/2024 Ganjil',
                'status' => 'Tidak Lulus',
                'id_dospem' => 1,
                'nilai' => '',
            ],
            [
                'nim' => '24060121130345',
                'periode_pkl' => '2022/2023 Genap',
                'status' => 'Tidak Lulus',
                'id_dospem' => 2,
                'nilai' => '',
            ],

            [
                'nim' => '24060120150002',
                'periode_pkl' => '2023/2024 Ganjil',
                'status' => 'Tidak Lulus',
                'id_dospem' => 2,
                'nilai' => '',
            ],
            [
                'nim' => '24060121131012',
                'periode_pkl' => '2022/2023 Genap',
                'status' => 'Tidak Lulus',
                'id_dospem' => 2,
                'nilai' => '',
            ],

        ];
        foreach ($riwayat_pkl as $rp){
            RiwayatPKL::create($rp);
        }
    }
}
