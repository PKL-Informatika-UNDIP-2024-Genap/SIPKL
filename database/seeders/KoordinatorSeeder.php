<?php

namespace Database\Seeders;

use App\Models\Koordinator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Koordinator::create([
            'id' => '101',
            'nip' => '199603032022041001',
            'nama' => 'Koordinator1',
        ]);
    }
}
