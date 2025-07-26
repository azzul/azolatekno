<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHarga extends Model
{
    use HasFactory;
    protected $table = 'jenis_harga';
    protected $primaryKey = 'id_jharga';

    protected $fillable = [
        'kode_jharga',
        'jenis_harga',
        'qty',
        'satuan',
        'created_at',
        'updated_at',


    ];

    public function harga()
    {
        return $this->hasMany(Harga::class, 'kode_jharga', 'kode_jharga');
    }

}
