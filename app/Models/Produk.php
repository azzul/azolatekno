<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_kategori',
        'kode_produk',
        'nama_produk',
        'image_produk',
        'long_desc',
        'short_desc',
        'slug_produk',
        'id_brand',
        'is_available',
        'created_at',
        'updated_at',
    ];

    /**
     * Relasi ke model Kategori.
     */

    public function harga()
    {
        return $this->hasMany(Harga::class, 'kode_produk', 'kode_produk');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Relasi ke model Warna.
     */
    public function warna()
    {
        return $this->belongsTo(Warna::class, 'kode_warna', 'kode_warna');
    }

    /**
     * Relasi ke model EtalaseKategori.
     */
    public function etalaseKategori()
    {
        return $this->belongsTo(EtalaseKategori::class, 'id_etalase', 'id_etalase');
    }

    /**
     * Relasi ke model KategoriWarna.
     */
 
     protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->kode_produk)) {
            $model->kode_produk = str_pad($model->id_kategori, 2, '0', STR_PAD_LEFT) . str_pad($model->id_produk ?? 0, 5, '0', STR_PAD_LEFT);
        }
    });
}

   public function variasi()
    {
        return $this->hasMany(VariasiProduk::class, 'kode_produk', 'kode_produk');
    }

    // Fungsi untuk mendapatkan variasi utama
    public function getVariasiUtama()
    {
        return $this->variasiProduk()->where('is_variasi_utama', 'Y')->first();
    }

public function addVariasi(array $variasiData)
{
    foreach ($variasiData as $data) {
        $this->variasiProduk()->create([
            'kode_variasi' => $this->kode_produk . '-' . $data['kode_variasi'],
            'atribut' => $data['atribut'],
            'value' => $data['value'],
            'satuan' => $data['satuan'] ?? null,
            'is_variasi_utama' => $data['is_variasi_utama'],
        ]);
    }
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
