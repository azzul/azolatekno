<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $primaryKey = 'id_setting';

    protected $fillable = [
        'setting_name',
        'status',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
