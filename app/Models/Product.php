<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion_corta',
        'descripcion_larga',
        'precio',
        'precio_promocion',
        'porcentaje_descuento',
        'categoria_id',
        'tipo',
        'pais',
        'region',
        'uva',
        'anada',
        'stock',
        'sku',
        'estado',
        'tags',
        'imagen_principal',
        'galeria',
        'destacado',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'precio_promocion' => 'decimal:2',
        'porcentaje_descuento' => 'integer',
        'anada' => 'integer',
        'stock' => 'integer',
        'estado' => 'integer',
        'tags' => 'array',
        'galeria' => 'array',
        'destacado' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'product_promotion')->withTimestamps();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
