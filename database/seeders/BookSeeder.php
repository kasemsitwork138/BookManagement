<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BookSeeder extends Seeder
{

    public function run(): void

    {

        // ผู้ดูแลระบบคนแรก

        Book::create([

            'title' => 'Romeo&Juliet',

            'author' => 'messi',


            'published_date' => '2023-01-01',

            'is_lend' => false,

        ]);
    }
}
