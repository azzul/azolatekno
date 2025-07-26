<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;

    protected $table = 'konten'; // Nama tabel
    protected $primaryKey = 'id_konten'; // Primary key
    public $timestamps = true; // Menggunakan created_at dan updated_at otomatis
    
    protected $fillable = [
        'nama_konten',
        'judul',
        'konten',
        'created_at',
        'updated_at'
    ];

    // Jika ingin mengubah format timestamps agar diisi otomatis
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}