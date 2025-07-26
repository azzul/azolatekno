<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warna extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'warna';
    protected $primaryKey = 'id_warna';
    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'kode_warna',
        'nama_warna',
        'color_name',
        'hex_color',
    ];

    // Tentukan kolom yang harus di-cast
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi dengan TipeWarna
    public function produk()
{
    return $this->hasMany(Produk::class, 'kode_warna', 'kode_warna');
}
}