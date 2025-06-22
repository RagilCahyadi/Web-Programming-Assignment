<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    protected $fillable = [
        'nama_barang',
        'merk',
        'stok',
        'harga',
        'deskripsi'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer'
    ];
}
