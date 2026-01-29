<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'judul' => 'Belajar Laravel API',
            'penulis' => 'Taylor Otwell',
            'stok' => 10,
        ]);

        Book::create([
            'judul' => 'React Atomic Design',
            'penulis' => 'Brad Frost',
            'stok' => 5,
        ]);
    }
} // Pastikan hanya ditutup dengan kurung kurawal class, tanpa koma