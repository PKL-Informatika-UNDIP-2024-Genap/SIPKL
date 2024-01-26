<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenPembimbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_dosbing = [
            [
                'nip' => '1272635890976',
                'nama' => 'Dr. Eng. Muhammad Nizam, S.T., M.T.',
                'golongan' => 'IV/a',
                'jabatan' => 'Pengajar',
            ],
            [
                'nip' => '12345678901234', // NIP Dosen 1
                'nama' => 'Dr. John Doe, S.T., M.T.',
                'golongan' => 'III/a',
                'jabatan' => 'Asisten Ahli',
            ],
            [
                'nip' => '23456789012345', // NIP Dosen 2
                'nama' => 'Prof. Dr. Jane Smith, S.T., M.T., Ph.D.',
                'golongan' => 'IV/b',
                'jabatan' => 'Lektor',
            ],
            [
                'nip' => '34567890123456', // NIP Dosen 3
                'nama' => 'Dr. Michael Johnson, S.T., M.T.',
                'golongan' => 'III/b',
                'jabatan' => 'Asisten Ahli',
            ],
            [
                'nip' => '45678901234567', // NIP Dosen 4
                'nama' => 'Prof. Dr. Maria Brown, S.T., M.T., Ph.D.',
                'golongan' => 'IV/c',
                'jabatan' => 'Lektor Kepala',
            ],
            [
                'nip' => '56789012345678', // NIP Dosen 5
                'nama' => 'Dr. Robert White, S.T., M.T.',
                'golongan' => 'III/a',
                'jabatan' => 'Pengajar',
            ],
            [
                'nip' => '67890123456789', // NIP Dosen 6
                'nama' => 'Prof. Dr. Emily Davis, S.T., M.T., Ph.D.',
                'golongan' => 'IV/d',
                'jabatan' => 'Guru Besar',
            ],
            [
                'nip' => '78901234567890', // NIP Dosen 7
                'nama' => 'Dr. Christopher Lee, S.T., M.T.',
                'golongan' => 'III/b',
                'jabatan' => 'Pengajar',
            ],
            [
                'nip' => '89012345678901', // NIP Dosen 8
                'nama' => 'Prof. Dr. Olivia Taylor, S.T., M.T., Ph.D.',
                'golongan' => 'IV/e',
                'jabatan' => 'Guru Besar',
            ],
            [
                'nip' => '90123456789012', // NIP Dosen 9
                'nama' => 'Dr. Andrew Wilson, S.T., M.T.',
                'golongan' => 'III/c',
                'jabatan' => 'Pengajar',
            ],
            [
                'nip' => '12312312312312', // NIP Dosen 10
                'nama' => 'Prof. Dr. Jessica Clark, S.T., M.T., Ph.D.',
                'golongan' => 'IV/a',
                'jabatan' => 'Lektor',
            ],
            [
                'nip' => '23423423423423', // NIP Dosen 11
                'nama' => 'Dr. Samuel Miller, S.T., M.T.',
                'golongan' => 'III/c',
                'jabatan' => 'Pengajar',
            ],
            [
                'nip' => '34534534534534', // NIP Dosen 12
                'nama' => 'Prof. Dr. Sophia Brown, S.T., M.T., Ph.D.',
                'golongan' => 'IV/b',
                'jabatan' => 'Lektor Kepala',
            ],
            [
                'nip' => '45645645645645', // NIP Dosen 13
                'nama' => 'Dr. William Harris, S.T., M.T.',
                'golongan' => 'III/d',
                'jabatan' => 'Asisten Ahli',
            ],
            [
                'nip' => '56756756756756', // NIP Dosen 14
                'nama' => 'Prof. Dr. Lily Wilson, S.T., M.T., Ph.D.',
                'golongan' => 'IV/c',
                'jabatan' => 'Guru Besar',
            ],
            [
                'nip' => '67867867867867', // NIP Dosen 15
                'nama' => 'Dr. Ethan Johnson, S.T., M.T.',
                'golongan' => 'III/d',
                'jabatan' => 'Asisten Ahli',
            ],
        ];

        foreach ($data_dosbing as $dosbing) {
            \App\Models\DosenPembimbing::create($dosbing);
        }
    }

    public static function generateRandomNIP(){
        return rand(10000000000000, 99999999999999);
    }
}
