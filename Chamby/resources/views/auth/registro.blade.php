<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Chamby</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center p-6 min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Crear Cuenta en Chamby</h2>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registro.guardar') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">DUI</label>
                    <input type="text" name="dui" id="dui" placeholder="00000000-0" value="{{ old('dui') }}" class="w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" maxlength="10" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Primer Nombre</label>
                    <input type="text" name="primer_nombre" placeholder="Ej: Juan" value="{{ old('primer_nombre') }}" class="solo-letras w-full border p-2 rounded focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Segundo Nombre</label>
                    <input type="text" name="segundo_nombre" placeholder="Ej: Antonio" value="{{ old('segundo_nombre') }}" class="solo-letras w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Primer Apellido</label>
                    <input type="text" name="primer_apellido" placeholder="Ej: Pérez" value="{{ old('primer_apellido') }}" class="solo-letras w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Segundo Apellido</label>
                    <input type="text" name="segundo_apellido" placeholder="Ej: López" value="{{ old('segundo_apellido') }}" class="solo-letras w-full border p-2 rounded">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="correo" placeholder="correo@ejemplo.com" value="{{ old('correo') }}" class="w-full border p-2 rounded" required>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <div class="flex gap-2">
                    <select name="codigo_pais" class="border p-2 rounded bg-gray-50">
                        <option value="503" {{ old('codigo_pais') == '503' ? 'selected' : '' }}>🇸🇻 +503</option>
                        <option value="504" {{ old('codigo_pais') == '504' ? 'selected' : '' }}>🇭🇳 +504</option>
                    </select>
                    <input type="text" name="telefono" id="telefono" placeholder="0000-0000" value="{{ old('telefono') }}" class="w-full border p-2 rounded" maxlength="9">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Departamento</label>
                    <select id="depto" name="departamento_id" class="w-full border p-2 rounded" required>
                        <option value="">Seleccione...</option>
                        @foreach($departamentos as $d)
                            <option value="{{ $d->id }}" {{ old('departamento_id') == $d->id ? 'selected' : '' }}>{{ $d->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Municipio</label>
                    <select id="muni" name="municipio_id" class="w-full border p-2 rounded" disabled required>
                        <option value="">Municipio</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Distrito</label>
                    <select id="distrito" name="distrito_id" class="w-full border p-2 rounded" disabled required>
                        <option value="">Distrito</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Tipo de Perfil</label>
                <select id="tipo_perfil" name="tipo_perfil" class="w-full border p-2 rounded">
                    <option value="empleado" {{ old('tipo_perfil') == 'empleado' ? 'selected' : '' }}>Soy Empleado (Busco Trabajo)</option>
                    <option value="empresa" {{ old('tipo_perfil') == 'empresa' ? 'selected' : '' }}>Soy Empresa (Busco Talento)</option>
                </select>
                <input type="text" name="campo_dinamico" id="label_dinamico" value="{{ old('campo_dinamico') }}" placeholder="Profesión (Contador, etc.)" class="w-full border p-2 mt-2 rounded border-blue-300 focus:ring-blue-500" required>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="contrasena" placeholder="Mínimo 8 caracteres y 1 especial" class="w-full border p-2 rounded" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-3 mt-6 rounded font-bold hover:bg-blue-700 transition duration-200">
                Finalizar Registro
            </button>
        </form>
    </div>

    <script>
        // 1. Máscara DUI (00000000-0)
        document.getElementById('dui').addEventListener('input', (e) => {
            let v = e.target.value.replace(/\D/g, '');
            if (v.length > 8) v = v.slice(0, 8) + '-' + v.slice(8, 9);
            e.target.value = v;
        });

        // 2. Máscara Teléfono El Salvador (0000-0000)
        document.getElementById('telefono').addEventListener('input', (e) => {
            let v = e.target.value.replace(/\D/g, '');
            if (v.length > 4) v = v.slice(0, 4) + '-' + v.slice(4, 8);
            e.target.value = v;
        });

        // 3. Validación: Solo letras y tildes para nombres/apellidos
        document.querySelectorAll('.solo-letras').forEach(el => {
            el.addEventListener('input', e => {
                e.target.value = e.target.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            });
        });

        // 4. Cascada de Ubicación (AJAX Fetch)
        const deptoSelect = document.getElementById('depto');
        const muniSelect = document.getElementById('muni');
        const distSelect = document.getElementById('distrito');

        deptoSelect.addEventListener('change', async (e) => {
            const deptoId = e.target.value;
            muniSelect.innerHTML = '<option value="">Cargando...</option>';
            distSelect.innerHTML = '<option value="">Distrito</option>';
            distSelect.disabled = true;

            if (deptoId) {
                try {
                    const res = await fetch(`/api/municipios/${deptoId}`);
                    const data = await res.json();
                    muniSelect.innerHTML = '<option value="">Seleccione Municipio</option>';
                    data.forEach(m => muniSelect.innerHTML += `<option value="${m.id}">${m.nombre}</option>`);
                    muniSelect.disabled = false;
                } catch (error) {
                    muniSelect.innerHTML = '<option value="">Error al cargar</option>';
                }
            }
        });

        muniSelect.addEventListener('change', async (e) => {
            const muniId = e.target.value;
            distSelect.innerHTML = '<option value="">Cargando...</option>';

            if (muniId) {
                try {
                    const res = await fetch(`/api/distritos/${muniId}`);
                    const data = await res.json();
                    distSelect.innerHTML = '<option value="">Seleccione Distrito</option>';
                    data.forEach(d => distSelect.innerHTML += `<option value="${d.id}">${d.nombre}</option>`);
                    distSelect.disabled = false;
                } catch (error) {
                    distSelect.innerHTML = '<option value="">Error al cargar</option>';
                }
            }
        });

        // 5. Perfil Dinámico (Placeholder dinámico)
        document.getElementById('tipo_perfil').addEventListener('change', (e) => {
            const label = document.getElementById('label_dinamico');
            if (e.target.value === 'empleado') {
                label.placeholder = "Profesión (Contador, Desarrollador, etc.)";
            } else {
                label.placeholder = "Giro de la Empresa (Venta de repuestos, Tecnología, etc.)";
            }
        });
    </script>
</body>
</html>