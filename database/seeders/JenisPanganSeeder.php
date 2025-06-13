<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPangan;

class JenisPanganSeeder extends Seeder
{
    public function run(): void
    {
        JenisPangan::insert([
            [
                'nama_pangan' => 'Rice',
                'satuan' => 'Kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pangan' => 'Sugar',
                'satuan' => 'Kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pangan' => 'Salt',
                'satuan' => 'Kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
