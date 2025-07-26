<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUtama extends Model
{
    use HasFactory;

    protected $table = 'kategori_utama';

    protected $primaryKey = 'id_ukategori';

    public $timestamps = false;

    protected $fillable = [
        'kategori_utama',
        'no_urut',
        'is_active',
        'datetime',
    ];
    public function categories()
    {
        return $this->hasMany(Kategori::class, 'id_ukategori', 'id_ukategori');
    }
}