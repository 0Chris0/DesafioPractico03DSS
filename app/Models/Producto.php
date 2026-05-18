<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = [// Campos del inventario con "$fillable"
        'nombre', 'talla', 'color', 'precio', 'stock', 'categoria_id', 'proveedor_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');//Uso de "belongsTo" para relacionar el producto con la categoria
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');//Uso de "belongsTo" para relacionar el producto con el proveedor
    }
}