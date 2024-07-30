<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Beastudi',
            'email' => 'admin@nf.mail',
            'password' => Hash::make('nurulfikri'),
            'email_verified_at' => now(),
            'role' => 'admin'
        ]);
    }
}
