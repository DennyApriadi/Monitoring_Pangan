<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        Lokasi::insert([
            [
                'nama_lokasi' => 'Gudang Utama',
                'provinsi' => 'Jawa Barat',
                'kota' => 'Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Gudang Timur',
                'provinsi' => 'Jawa Timur',
                'kota' => 'Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Gudang Tengah',
                'provinsi' => 'DKI Jakarta',
                'kota' => 'Jakarta Selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
