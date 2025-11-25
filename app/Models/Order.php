<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Campos que permitimos llenar masivamente
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'shipping_address',
        'notes'
    ];

    // Relación: Una orden pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Una orden tiene muchos Productos (a través de la tabla pivote order_product)
    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity', 'price') // Recuperamos cantidad y precio histórico
                    ->withTimestamps();
    }
}