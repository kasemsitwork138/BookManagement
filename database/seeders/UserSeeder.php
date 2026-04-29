<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void

    {

        // ผู้ดูแลระบบคนแรก

        User::create([

            'name' => 'Admin User',

            'email' => 'admin@example.com',

            'password' => Hash::make('password123'), // เข้ารหัสรหัสผ่าน

        ]);


        // ผู้ใช้ทั่วไป

        User::create([

            'name' => 'Test User',

            'email' => 'user@example.com',

            'password' => Hash::make('123456'),

        ]);

    }
}
