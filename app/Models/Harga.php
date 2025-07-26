<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'harga';
    protected $primaryKey = 'id_harga';
    protected $fillable = [
        'kode_variasi',
        'kode_produk',
        'harga',
        'diskon',
        'harga_ecer',
        'satuan',
        'created_at',
        'updated_at',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
    }

    public function jenisHarga()
    {
        return $this->belongsTo(JenisHarga::class, 'kode_jharga', 'kode_jharga');
    }

}
