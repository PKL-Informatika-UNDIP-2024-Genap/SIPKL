<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_user = [
            [
                'username' => '24060121130086',
                'password' => Hash::make('24060121130086'),
                'is_admin' => 0,
                'status' => 1,
            ],
            [
                'username' => '24060121130050',
                'password' => Hash::make('24060121130050'),
                'is_admin' => 0,
                'status' => 1,
            ],
        ];
        for ($i = 1; $i <= 100; $i++) {
            $username = 24060121100000 + $i;
            $data_user[] = [
                'username' => "$username",
                'password' => Hash::make("$username"),
                'is_admin' => 0,
                'status' => 1,
            ];
        }

        foreach ($data_user as $user) {
            User::create($user);
        }
    }
}
