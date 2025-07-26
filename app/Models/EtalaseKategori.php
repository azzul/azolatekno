<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtalaseKategori extends Model
{
    use HasFactory;

    protected $table = 'etalase_kategori';

    protected $primaryKey = 'id_etalase';

    protected $fillable = [
        'id_kategori',
        'etalase',
        'img_etalase',
        'created_at',
        'updated_at',
    ];

    /**
     * Relasi ke model Kategori.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
    public function kontenEtalaseKategori()
    {
        return $this->hasMany(KontenEtalaseKategori::class, 'id_etalase', 'id_etalase');
    }
    public function produk()
{
    return $this->hasMany(Produk::class, 'id_etalase', 'id_etalase');
}
    public function harga()
    {
        return $this->hasMany(Harga::class, 'id_etalase', 'id_etalase');
    }
}
