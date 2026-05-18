<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';//Nombre de la tabal
    protected $fillable = ['nombre'];//Uso de $fillable

    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id'); //Relacion de uno a muchos "hasMany"
    }
}