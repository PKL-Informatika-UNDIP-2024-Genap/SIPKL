<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformasiLainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $informasi_lain = [
            [
                'nama' => 'Grup Whatsapp',
                'value' => 'https://chat.whatsapp.com/invite/8Zzv3Z6Z6Zz7Zzv3Z6Zz7Z',
            ],
            [
                'nama' => 'Alamat',
                'value' => 'Jl. Prof. Soedarto No.50275, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275',
            ],
            [
                'nama' => 'Email',
                'value' => 'pkl.if@live.undip.ac.id',
            ],
            [
                'nama' => 'Youtube',
                'value' => 'https://www.youtube.com/channel/FakultasSainsdanMatematikaUndip',
            ],
            [
                'nama' => 'Twitter',
                'value' => 'https://twitter.com/fsm_undip',
            ],
            [
                'nama' => 'Instagram',
                'value' => 'https://www.instagram.com/if.undip/',
            ],
            [
                'nama' => 'Laman Undip',
                'value' => 'https://www.undip.ac.id/',
            ],
            [
                'nama' => 'Laman FSM Undip',
                'value' => 'https://fsm.undip.ac.id/',
            ],
            [
                'nama' => 'Laman IF Undip',
                'value' => 'https://if.fsm.undip.ac.id/',
            ],
            [
                'nama' => 'Jadwal Praktikum IF',
                'value' => 'https://docs.google.com/spreadsheets/d/',
            ],
        ];

        foreach ($informasi_lain as $informasi) {
            \App\Models\InformasiLain::create($informasi);
        }
    }
}
