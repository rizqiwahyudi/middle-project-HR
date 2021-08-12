<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'first_name' => 'admin',
            'last_name' => 'company',
            'email' => 'admin@admin.com',
            'telepon' => '+62'.random_int(00000000000, 99999999999),
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'company_id' => 1,
            'department_id' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'username' => 'user',
            'first_name' => 'user',
            'last_name' => 'company',
            'email' => 'user@user.com',
            'telepon' => '+62'.random_int(00000000000, 99999999999),
            'password' => Hash::make('password123'),
            'company_id' => 1,
            'department_id' => 2,
            'remember_token' => Str::random(10),
        ]);

        User::factory(10)->create();
    }
}
