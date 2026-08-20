<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomContent extends Model
{
    use HasFactory;

    protected $table = 'custom_content';
    protected $primaryKey = 'id_content';
    public $timestamps = true;
    
    protected $fillable = [
        'judul',
        'page_name',
        'slug_content',
        'short_desc',
        'isi',
        'keyword',
        'kategori_konten',
        'img_content',
        'img_medium',
        'img_small',
        'is_product',
        'created_at',
        'updated_at'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
