<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Prenda - Tienda de Ropa</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <div class="max-w-3xl mx-auto px-4 py-10">
        
        <div class="mb-6">
            <a href="{{ route('productos.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                ← Volver al Inventario
            </a>
        </div>

        <div class="pb-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Ficha Técnica del Producto</h1>
                <p class="mt-2 text-sm text-slate-600">Detalles completos y relaciones en base de datos para el ID #{{ $producto->id }}.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('productos.edit', $producto->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-semibold rounded-lg text-white bg-amber-500 hover:bg-amber-600 shadow-sm transition-all">
                    Editar Datos
                </a>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-bold text-slate-900">{{ $producto->nombre }}</h2>
            </div>
            
            <div class="p-6 divide-y divide-slate-100">
                <div class="py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Categoría</span>
                    <span class="sm:col-span-2 text-sm font-medium text-slate-900">
                        <span class="px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $producto->categoria->nombre }}
                        </span>
                    </span>
                </div>

                <div class="py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Especificaciones</span>
                    <span class="sm:col-span-2 text-sm text-slate-900">
                        Talla: <span class="font-bold">{{ $producto->talla }}</span> &nbsp;|&nbsp; 
                        Color: <span class="font-medium text-slate-600">{{ $producto->color ?? 'No especificado' }}</span>
                    </span>
                </div>

                <div class="py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Precio de Venta</span>
                    <span class="sm:col-span-2 text-lg font-bold text-indigo-600">${{ number_format($producto->precio, 2) }}</span>
                </div>

                <div class="py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Disponibilidad</span>
                    <span class="sm:col-span-2 text-sm">
                        @if($producto->stock > 10)
                            <span class="text-green-700 font-bold bg-green-50 px-2.5 py-1 rounded-md border border-green-100">{{ $producto->stock }} unidades (Stock Estable)</span>
                        @elseif($producto->stock > 0)
                            <span class="text-amber-700 font-bold bg-amber-50 px-2.5 py-1 rounded-md border border-amber-100">{{ $producto->stock }} unidades (Stock Bajo)</span>
                        @else
                            <span class="text-red-700 font-bold bg-red-50 px-2.5 py-1 rounded-md border border-red-100">Agotado de Bodega</span>
                        @endif
                    </span>
                </div>

                <div class="py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Proveedor</span>
                    <span class="sm:col-span-2 text-sm text-slate-900">
                        <div class="font-bold text-slate-800">{{ $producto->proveedor->nombre }}</div>
                        <div class="text-xs text-slate-500 mt-0.5">Asesor: {{ $producto->proveedor->contacto_asesor }} &nbsp;•&nbsp; Tel: {{ $producto->proveedor->telefono }}</div>
                    </span>
                </div>

                <div class="py-4 grid grid-cols-1 sm:grid-cols-3 gap-2 text-xs text-slate-400">
                    <span>Registro del Sistema</span>
                    <span class="sm:col-span-2 space-y-1">
                        <div>Creado el: {{ $producto->created_at->format('d/m/Y h:i A') }}</div>
                        <div>Última modificación: {{ $producto->updated_at->format('d/m/Y h:i A') }}</div>
                    </span>
                </div>
            </div>
        </div>

    </div>

</body>
</html>