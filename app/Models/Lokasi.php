<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_lokasi', 'provinsi', 'kota'];

    // Definisikan relasi dengan StokPangan
    public function stokPangans()
    {
        return $this->hasMany(StokPangan::class);
    }
}
