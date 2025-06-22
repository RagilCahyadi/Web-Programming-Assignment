<?php

namespace Database\Seeders;

use App\Models\Bengkel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BengkelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangBengkel = [
            [
                'nama_barang' => 'Busi Filter Udara',
                'merk' => 'Ahass',
                'stok' => 30,
                'harga' => 100000.00,
                'deskripsi' => 'Busi filter udara untuk motor Honda dengan kualitas original dan daya tahan tinggi.'
            ],
            [
                'nama_barang' => 'Oli Mesin Synthetic',
                'merk' => 'Shell',
                'stok' => 25,
                'harga' => 150000.00,
                'deskripsi' => 'Oli mesin synthetic premium yang memberikan perlindungan maksimal untuk mesin kendaraan.'
            ],
            [
                'nama_barang' => 'Ban Motor Ring 14',
                'merk' => 'Michelin',
                'stok' => 15,
                'harga' => 350000.00,
                'deskripsi' => 'Ban motor ring 14 dengan grip optimal dan ketahanan terhadap berbagai kondisi jalan.'
            ],
            [
                'nama_barang' => 'Kampas Rem Cakram',
                'merk' => 'Brembo',
                'stok' => 40,
                'harga' => 75000.00,
                'deskripsi' => 'Kampas rem cakram berkualitas tinggi untuk pengereman yang optimal dan aman.'
            ],
            [
                'nama_barang' => 'Rantai Motor',
                'merk' => 'DID',
                'stok' => 20,
                'harga' => 200000.00,
                'deskripsi' => 'Rantai motor berkekuatan tinggi dengan teknologi O-ring untuk daya tahan ekstra.'
            ],
            [
                'nama_barang' => 'Aki Motor 12V',
                'merk' => 'Yuasa',
                'stok' => 12,
                'harga' => 450000.00,
                'deskripsi' => 'Aki motor 12V dengan teknologi maintenance free dan daya start yang kuat.'
            ],
            [
                'nama_barang' => 'Lampu LED Headlight',
                'merk' => 'Philips',
                'stok' => 35,
                'harga' => 125000.00,
                'deskripsi' => 'Lampu LED headlight dengan cahaya terang dan hemat energi untuk visibilitas optimal.'
            ]
        ];

        foreach ($barangBengkel as $barang) {
            Bengkel::create($barang);
        }
    }
}
