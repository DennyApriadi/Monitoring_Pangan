<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPangan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pangan', 'satuan'];

    // Definisikan relasi dengan StokPangan
    public function stokPangans()
    {
        return $this->belongsTo(JenisPangan::class, 'pangan_id');
    }
}
