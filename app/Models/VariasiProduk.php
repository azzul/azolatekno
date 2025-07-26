<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariasiProduk extends Model
{
    use HasFactory;

    protected $table = 'variasi_produk';
    protected $primaryKey = 'id_variasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_variasi',
        'kode_produk',
        'atribut',
        'value',
        'is_variasi_utama',
        'created_at',
        'updated_at',
    ];

    // Relationship with Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
    }

     public function addVariasiWithDetails(array $data)
    {
        // Simpan kode variasi utama
        $variasiUtama = [
            'kode_variasi' => $data['kode_variasi'],
            'kode_produk' => $this->kode_produk,
            'is_variasi_utama' => $data['is_variasi_utama'],
        ];

        // Simpan data variasi utama
        $variasi = VariasiProduk::create($variasiUtama);

        // Simpan detail variasi
        foreach ($data['variasi'] as $detail) {
            $variasi->details()->create([
                'atribut' => $detail['atribut'],
                'value' => $detail['value'],
                'satuan' => $detail['satuan'] ?? null,
            ]);
        }
    }
}