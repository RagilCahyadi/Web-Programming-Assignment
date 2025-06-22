<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'bukus';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'judul',
        'penulis', 
        'tahun_terbit',
        'penerbit',
        'kategori',
        'deskripsi'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'tahun_terbit' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
