<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterVariasi extends Model
{
    use HasFactory;

    protected $table = 'parameter_variasi';
    protected $primaryKey = 'id_parameter';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'parameter',
        'id_kategori',
        'is_required',
        'created_at',
        'updated_at',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}