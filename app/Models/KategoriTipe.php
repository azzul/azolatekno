<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTipe extends Model
{
    use HasFactory;

    protected $table = 'kategori_tipe';

    protected $primaryKey = 'kode_ktgtipe';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id_ktgtipe',
        'kode_ktgtipe',
        'tipe_kategori',
        'created_at',
    ];

    public function kategoris()
    {
        return $this->hasMany(Kategori::class, 'kode_ktgtipe', 'kode_ktgtipe');
    }
}