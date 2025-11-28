<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'banner',
        'fecha_inicio',
        'fecha_fin',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_promotion')->withTimestamps();
    }
}
