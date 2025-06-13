<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokPangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'lokasi_id', 'pangan_id', 'jumlah_stok', 'tanggal_input', 'status'
    ];

    // Definisikan relasi dengan Lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    // Definisikan relasi dengan JenisPangan
    public function pangan()
    {
        return $this->belongsTo(JenisPangan::class, 'pangan_id');
    }
}
