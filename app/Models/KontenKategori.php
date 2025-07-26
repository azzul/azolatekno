<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenKategori extends Model
{
    use HasFactory;

    protected $table = 'konten_kategori';

    protected $primaryKey = 'id_konten';

    protected $fillable = [
        'id_kategori',
        'long_desc',
        'penggunaan',
        'perawatan',
        'img_konten',
        'src_video',
        'created_at',
        'updated_at',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}