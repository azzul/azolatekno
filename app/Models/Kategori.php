<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $primaryKey = 'id_kategori';

    public $incrementing = true;

    protected $fillable = [
        'nama_kategori',
        'img_kategori',
        'slug_kategori',
        'kode_ktgtipe',
        'tipe_kategori',
        'id_ukategori',
        'deskripsi_kategori',
        'is_active',
        'no_urut',
    ];

     public function kategoriTipe()
    {
        // Pastikan relasi ini benar
        return $this->belongsTo(KategoriTipe::class, 'kode_ktgtipe', 'kode_ktgtipe');
    }

    public function kategoriUtama()
    {
        return $this->belongsTo(KategoriUtama::class, 'id_ukategori', 'id_ukategori');
    }
     public function etalaseKategori()
    {
        return $this->hasMany(EtalaseKategori::class, 'id_kategori', 'id_kategori');
    }
    public function kontenKategori()
    {
        return $this->hasMany(KontenKategori::class, 'id_kategori', 'id_kategori');
    }
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori');
    }

    // Menggunakan event untuk mengisi kode_ktgtipe
     public function harga()
    {
        return $this->hasMany(Harga::class, 'id_kategori', 'id_kategori');
    }

    public function getEtalaseAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function parameter()
    {
        return $this->hasMany(ParameterVariasi::class, 'id_kategori', 'id_kategori');
    }

}