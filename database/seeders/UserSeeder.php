<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'role' => 1,//admin
            'active' => 1,//active
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'username' => 'janesmith',
            'role' => 2,//pegawai
            'active' => 1,//active
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Mark Johnson',
            'username' => 'markjohnson',
            'role' => 2,//pegawai
            'active' => 2,//non active
            'email' => 'mark@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
