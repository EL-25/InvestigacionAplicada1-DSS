<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Perfil - Chamby</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-2xl mx-auto mt-20 bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold text-blue-800 mb-6">Editar Perfil</h2>

        <form action="{{ route('dashboard.actualizar') }}" method="POST">
            @csrf

            @if(Auth::user()->tipo_perfil === 'empleado')
                <!-- Campos para empleado -->
                <div class="mb-4">
                    <label class="block text-gray-700">Primer Nombre</label>
                    <input type="text" name="primer_nombre" value="{{ Auth::user()->primer_nombre }}" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Primer Apellido</label>
                    <input type="text" name="primer_apellido" value="{{ Auth::user()->primer_apellido }}" class="w-full border rounded px-3 py-2">
                </div>
            @else
                <!-- Campos para empresa -->
                <div class="mb-4">
                    <label class="block text-gray-700">Nombre Empresa</label>
                    <input type="text" name="nombre_empresa" value="{{ Auth::user()->nombre_empresa }}" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Razón Social</label>
                    <input type="text" name="razon_social" value="{{ Auth::user()->razon_social }}" class="w-full border rounded px-3 py-2">
                </div>
            @endif

            <!-- Campos comunes -->
            <div class="mb-4">
                <label class="block text-gray-700">Correo</label>
                <input type="email" name="correo" value="{{ Auth::user()->correo }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Teléfono</label>
                <input type="text" name="telefono" value="{{ Auth::user()->telefono }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('dashboard.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar Cambios</button>
            </div>
        </form>
    </div>
</body>
</html>
