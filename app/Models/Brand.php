<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brand';
    protected $primaryKey = 'id_brand';
    public $timestamps = true;

    protected $fillable = [
        'brand',
        'img_brand',
        'created_at',
        'updated_at',
    ];
}
