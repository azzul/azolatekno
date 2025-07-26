<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeWarna extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'tipe_warna';

    protected $primaryKey = 'id_tipewarna';
    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'tipe_warna',
    ];

    // Tentukan kolom yang harus di-cast
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function warnas()
    {
        return $this->hasMany(Warna::class, 'id_tipewarna');
    }
}
