<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'proveedor'])->get(); //Uso de consultas con "Eloquent" para productos con sus categorias y proveedores relacionados
        
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        //Se listan las categorías y proveedores para los select del formulario
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        
        return view('productos.create', compact('categorias', 'proveedores'));
    }

    public function store(StoreProductoRequest $request)//Se guardan en la base de datos y uso de REQUEST para validar los datos del formulario
    {
        // Se guardan los datos en la base de datos con el $fillable de los modelos 
        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Prenda de ropa agregada con éxito.');
    }

    public function show($id)//Se muestra el detalle del producto con su categoria y proveedor relacionados
    {
        $producto = Producto::with(['categoria', 'proveedor'])->findOrFail($id); //Consulta con Eloquent que con ayuda de Query Builder tiene el producto con su categoria y proveedor relacionados
        return view('productos.show', compact('producto'));
    }

    public function edit($id)//Se editan los datos del producto en la base de datos aqui no se usa el REQUEST porque solo se muestra el formulario con los datos del producto
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        
        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(UpdateProductoRequest $request, $id)//Se actualizan los datos en la base de datos, el REQUEST se usa para validar los datos del formulario de edición
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Inventario actualizado con éxito.');
    }

    public function destroy($id)//Se elimina el producto de la base de datos
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Prenda eliminada correctamente.');
    }
}