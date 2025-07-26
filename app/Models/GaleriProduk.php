<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriProduk extends Model
{
    use HasFactory;

    protected $table = 'galeri_produk';

    protected $primaryKey = 'id_image';

    public $timestamps = true;

    protected $fillable = [
        'kode_produk',
        'src_image',
        'is_utama',
        'desc_image',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
    }
}