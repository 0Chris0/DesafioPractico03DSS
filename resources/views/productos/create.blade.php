<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Prenda - Tienda de Ropa</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <div class="max-w-3xl mx-auto px-4 py-10">
        
        <div class="mb-6">
            <a href="{{ route('productos.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                ← Volver al Inventario
            </a>
        </div>

        <div class="pb-6 border-b border-slate-200">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Registrar Nueva Prenda</h1>
            <p class="mt-2 text-sm text-slate-600">Completa los campos para añadir un nuevo producto al inventario de ropa.</p>
        </div>

        <form action="{{ route('productos.store') }}" method="POST" class="mt-8 space-y-6 bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            @csrf 

            <div>
                <label for="nombre" class="block text-sm font-medium text-slate-700">Nombre de la Prenda o Artículo</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="mt-1 block w-full rounded-md border-slate-300 px-3 py-2 border shadow-xs focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="Ej. Camisa Manga Larga Formal">
                @error('nombre') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror {{-- Validación de errores para el campo nombre --}}
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="talla" class="block text-sm font-medium text-slate-700">Talla</label>
                    <select name="talla" id="talla" class="mt-1 block w-full rounded-md border-slate-300 px-3 py-2 border shadow-xs focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="" disabled selected>Selecciona una talla</option>
                        <option value="S" {{ old('talla') == 'S' ? 'selected' : '' }}>S (Small)</option>
                        <option value="M" {{ old('talla') == 'M' ? 'selected' : '' }}>M (Medium)</option>
                        <option value="L" {{ old('talla') == 'L' ? 'selected' : '' }}>L (Large)</option>
                        <option value="XL" {{ old('talla') == 'XL' ? 'selected' : '' }}>XL (Extra Large)</option>
                    </select>
                    @error('talla') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror {{-- Validación de errores para el campo talla --}}
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-slate-700">Color</label>
                    <input type="text" name="color" id="color" value="{{ old('color') }}" class="mt-1 block w-full rounded-md border-slate-300 px-3 py-2 border shadow-xs focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="Ej. Azul Marino">
                    @error('color') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror {{-- Validación de errores para el campo color --}}
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="precio" class="block text-sm font-medium text-slate-700">Precio de Venta ($)</label>
                    <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio') }}" class="mt-1 block w-full rounded-md border-slate-300 px-3 py-2 border shadow-xs focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="0.00">
                    @error('precio') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror {{-- Validación de errores para el campo precio --}}
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-slate-700">Cantidad en Stock (Unidades)</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}" class="mt-1 block w-full rounded-md border-slate-300 px-3 py-2 border shadow-xs focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="0">
                    @error('stock') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror {{-- Validación de errores para el campo stock --}}
                </div>
            </div>

            <div>
                <label for="categoria_id" class="block text-sm font-medium text-slate-700">Categoría de Ropa</label>
                <select name="categoria_id" id="categoria_id" class="mt-1 block w-full rounded-md border-slate-300 px-3 py-2 border shadow-xs focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="" disabled selected>Selecciona una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror {{-- Validación de errores para el campo categoría --}}
            </div>

            <div>
                <label for="proveedor_id" class="block text-sm font-medium text-slate-700">Proveedor Distribuidor</label>
                <select name="proveedor_id" id="proveedor_id" class="mt-1 block w-full rounded-md border-slate-300 px-3 py-2 border shadow-xs focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                    <option value="" disabled selected>Selecciona un proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                            {{ $proveedor->nombre }} (Asesor: {{ $proveedor->contacto_asesor }})
                        </option>
                    @endforeach
                </select>
                @error('proveedor_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror {{-- Validación de errores para el campo proveedor --}}
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('productos.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md shadow-xs hover:bg-slate-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-xs hover:bg-indigo-700 cursor-pointer">
                    Guardar Producto
                </button>
            </div>
        </form>

    </div>

</body>
</html>