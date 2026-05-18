<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    // IMPORTANTE: Cambiar a true para permitir el uso de esta validación
    public function authorize(): bool
    {
        return true;
    }

    // Reglas de validación idénticas a las que pide la estructura de tu BD
    public function rules(): array
    {
        return [
            'nombre'        => 'required|string|max:150',
            'talla'         => 'required|string|max:10',
            'color'         => 'nullable|string|max:50',
            'precio'        => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'categoria_id'  => 'required|exists:categorias,id',
            'proveedor_id'  => 'required|exists:proveedores,id',
        ];
    }

    public function messages(): array
    {
        return [ //Estos mensajes solo son cuando se guardar un nuevo producto
            'nombre.required'       => 'El nombre o descripción de la prenda es obligatorio.',
            'nombre.max'            => 'El nombre no debe superar los 150 caracteres.',
            'talla.required'        => 'Debes seleccionar una talla para la prenda.',
            'precio.required'       => 'El precio de venta es obligatorio.',
            'precio.numeric'        => 'El precio debe ser un número válido.',
            'precio.min'            => 'El precio no puede ser un número negativo.',
            'stock.required'        => 'La cantidad en stock es obligatoria.',
            'stock.integer'         => 'El stock debe ser un número entero.',
            'stock.min'             => 'El stock no puede ser menor a 0.',
            'categoria_id.required' => 'Debes asignar una categoría de ropa.',
            'categoria_id.exists'   => 'La categoría seleccionada no es válida.',
            'proveedor_id.required' => 'Debes asignar un proveedor distribuidor.',
            'proveedor_id.exists'   => 'El proveedor seleccionado no es válida.',
        ];
    }
}