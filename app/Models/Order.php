<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'user_id',
        'nombre_cliente',
        'email_cliente',
        'telefono_cliente',
        'estado',
        'metodo_entrega',
        'total',
        'notas_cliente',
        'notas_internas',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
