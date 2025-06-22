<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

/**
 * Seeder untuk mengisi tabel bukus dengan data contoh
 * Digunakan untuk testing dan development
 */
class BukuSeeder extends Seeder
{
    /**
     * Menjalankan seeding data buku
     *
     * @return void
     */
    public function run(): void
    {
        $bukus = [
            [
                'judul' => 'Laravel 10: From Beginner to Advanced',
                'penulis' => 'John Doe',
                'tahun_terbit' => 2023,
                'penerbit' => 'Tech Publishers',
                'kategori' => 'Teknologi',
                'deskripsi' => 'Panduan lengkap belajar Laravel 10 dari dasar hingga mahir dengan berbagai contoh project nyata.'
            ],            [
                'judul' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'penulis' => 'Robert C. Martin',
                'tahun_terbit' => 2008,
                'penerbit' => 'Prentice Hall',
                'kategori' => 'Teknologi',
                'deskripsi' => 'Buku yang mengajarkan prinsip-prinsip penulisan kode yang bersih dan mudah dipelihara.'
            ],
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'tahun_terbit' => 2018,
                'penerbit' => 'Avery',
                'kategori' => 'Self-Development',
                'deskripsi' => 'Cara membangun kebiasaan baik dan menghilangkan kebiasaan buruk dengan metode yang telah terbukti.'
            ],
            [
                'judul' => 'The Pragmatic Programmer',
                'penulis' => 'David Thomas & Andrew Hunt',
                'tahun_terbit' => 1999,
                'penerbit' => 'Addison-Wesley',
                'kategori' => 'Teknologi',
                'deskripsi' => 'Panduan praktis untuk menjadi programmer yang lebih efektif dan profesional.'
            ],
            [
                'judul' => 'Pemrograman Web dengan PHP dan MySQL',
                'penulis' => 'Abdul Kadir',
                'tahun_terbit' => 2022,
                'penerbit' => 'Andi Publisher',
                'kategori' => 'Pendidikan',
                'deskripsi' => 'Buku pembelajaran pemrograman web menggunakan PHP dan MySQL untuk pemula.'
            ]
        ];

        foreach ($bukus as $buku) {
            Buku::create($buku);
        }
    }
}
