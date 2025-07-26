<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriWarna extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'kategori_warna';

    protected $primaryKey = 'id_ktgwarna';
    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'kategori_warna',
    ];

    // Tentukan kolom yang harus di-cast
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function warna()
    {
        return $this->hasMany(Warna::class, 'id_ktgwarna', 'id_ktgwarna');
    }
    public function harga()
    {
        return $this->hasMany(Harga::class, 'id_ktgwarna', 'id_ktgwarna');
    }
}
