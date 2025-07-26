<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'toko';

    // Primary key
    protected $primaryKey = 'id_toko';

    // Tidak menggunakan auto-increment pada primary key
    public $incrementing = false;

    // Tipe primary key
    protected $keyType = 'int';

    // Kolom-kolom yang bisa diisi
    protected $fillable = [
        'kode_toko',
        'nama_toko',
        'phone_toko',
        'wa_toko',
        'foto_toko',
        'alamat',
        'company',
        'kota',
        'provinsi',
        'kode_pos',
        'kota_terdekat',
        'latitude',
        'longitude',
        'link_gmaps',
        'iframe_gmaps',
        'nama_gmaps',
        'slug_toko',
        'long_desc',
    ];

    // Kolom yang tidak ingin ditampilkan secara langsung (opsional)
    protected $hidden = [];

    // Cast data tertentu ke tipe yang sesuai
    protected $casts = [
        'kode_pos' => 'integer',
        'latitude' => 'string',
        'longitude' => 'string',
    ];
}