<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk membuat tabel bukus
 * Tabel ini menyimpan informasi lengkap tentang buku
 */
return new class extends Migration
{
    /**
     * Menjalankan migration untuk membuat tabel bukus
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255)->comment('Judul buku');
            $table->string('penulis', 255)->comment('Nama penulis buku');
            $table->integer('tahun_terbit')->comment('Tahun buku diterbitkan');
            $table->string('penerbit', 255)->comment('Nama penerbit');
            $table->string('kategori', 100)->comment('Kategori/genre buku');
            $table->text('deskripsi')->nullable()->comment('Deskripsi singkat buku');
            $table->timestamps();
        });
    }

    /**
     * Rollback migration - menghapus tabel bukus
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
