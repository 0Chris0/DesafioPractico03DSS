<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';
    protected $fillable = ['nombre', 'telefono', 'contacto_asesor'];//Campos para guardar datos de los proveedores con "$fillable"

    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id');//Uso de "hasMany" para relacionar el proveedor con los productos
    }
}