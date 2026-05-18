<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Tienda de Ropa</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-slate-200">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Control de Inventario</h1>
                <p class="mt-2 text-sm text-slate-600">Gestión de prendas de ropa, categorías y proveedores de la tienda.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('productos.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-all duration-150">
                    + Agregar Nueva Prenda
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mt-6 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 flex items-center shadow-sm animate-fade-in" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <div>
                    <span class="font-bold">Hecho</span> {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="mt-8 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-500">
                    <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-bold">ID</th>
                            <th scope="col" class="px-6 py-4 font-bold">Prenda / Nombre</th>
                            <th scope="col" class="px-6 py-4 font-bold">Categoría</th>
                            <th scope="col" class="px-6 py-4 font-bold">Talla/Color</th>
                            <th scope="col" class="px-6 py-4 font-bold">Precio</th>
                            <th scope="col" class="px-6 py-4 font-bold">Stock</th>
                            <th scope="col" class="px-6 py-4 font-bold">Proveedor</th>
                            <th scope="col" class="px-6 py-4 font-bold text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($productos as $producto)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-6 py-4 font-semibold text-slate-900">#{{ $producto->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900">{{ $producto->nombre }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $producto->categoria->nombre }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    <span class="font-medium text-slate-900">{{ $producto->talla }}</span> 
                                    <span class="text-slate-400">|</span> 
                                    {{ $producto->color ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-900">${{ number_format($producto->precio, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if($producto->stock > 10)
                                        <span class="text-green-600 font-semibold">{{ $producto->stock }} uds</span>
                                    @elseif($producto->stock > 0)
                                        <span class="text-amber-600 font-semibold">{{ $producto->stock }} uds (Bajo)</span>
                                    @else
                                        <span class="bg-red-50 text-red-700 px-2 py-0.5 rounded text-xs font-bold">Agotado</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600 max-w-[150px] truncate">
                                    {{ $producto->proveedor->nombre }}
                                </td>
                                <td class="px-6 py-4 space-x-2 whitespace-nowrap text-center">
                                    <a href="{{ route('productos.show', $producto->id) }}" class="inline-flex items-center px-3 py-1.5 border border-slate-200 text-xs font-semibold rounded-md text-slate-700 bg-white hover:bg-slate-50 shadow-xs transition-all">
                                        Ver
                                    </a>
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-semibold rounded-md text-white bg-amber-500 hover:bg-amber-600 shadow-xs transition-all">
                                        Editar
                                    </a>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar esta prenda del inventario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-semibold rounded-md text-white bg-red-600 hover:bg-red-700 shadow-xs transition-all cursor-pointer">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-slate-400">
                                    <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-base font-semibold text-slate-600">No hay prendas en el inventario</p>
                                    <p class="text-xs text-slate-400 mt-1">Presiona el botón de arriba para registrar tu primer producto.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>