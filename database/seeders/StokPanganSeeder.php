<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StokPangan;

class StokPanganSeeder extends Seeder
{
    public function run(): void
    {
        StokPangan::insert([
            [
                'user_id' => 1,
                'lokasi_id' => 1,
                'pangan_id' => 1,
                'jumlah_stok' => 100.00,
                'tanggal_input' => now(),
                'status' => 'Aman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'lokasi_id' => 2,
                'pangan_id' => 2,
                'jumlah_stok' => 50.00,
                'tanggal_input' => now(),
                'status' => 'Waspada',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'lokasi_id' => 3,
                'pangan_id' => 3,
                'jumlah_stok' => 30.50,
                'tanggal_input' => now(),
                'status' => 'Kritikal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
