<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenEtalaseKategori extends Model
{
    use HasFactory;

    protected $table = 'konten_etalase_kategori';

    protected $primaryKey = 'id_ekonten';

    protected $fillable = [
        'id_etalase',
        'judul',
        'isi',
        'jenis_konten',
        'img_konten',
        'created_at',
        'updated_at',
    ];

    /**
     * Relasi ke model EtalaseKategori.
     */
    public function etalaseKategori()
    {
        return $this->belongsTo(EtalaseKategori::class, 'id_etalase', 'id_etalase');
    }
}