<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ArsipPKL;
use App\Models\PeriodePKL;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\DokumenSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\PengumumanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'username' => '101',
            'password' => Hash::make('0'),
            'is_admin' => 1,
            'status' => 1,
        ]);

        $this->call([
            KoordinatorSeeder::class,
            PengumumanSeeder::class,
            DokumenSeeder::class,
            DosenPembimbingSeeder::class,
            MahasiswaSeeder::class,
            UserSeeder::class,
            PeriodePKLSeeder::class,
            PKLSeeder::class,
            SeminarPKLSeeder::class,
            ArsipPKLSeeder::class,
            RiwayatPKLSeeder::class,
            CetakSKSeeder::class,
        ]);
    }
}
