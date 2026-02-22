<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chamby - Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Chamby</h2>
        
        <form action="{{ route('login.entrar') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Correo Electrónico</label>
                <input type="email" name="correo" class="w-full border p-2 rounded mt-1" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700">Contraseña</label>
                <input type="password" name="contrasena" class="w-full border p-2 rounded mt-1" required>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded font-bold hover:bg-blue-700">
                Entrar
            </button>
        </form>
        
        <p class="mt-4 text-center text-sm text-gray-600">
            ¿No tienes cuenta? <a href="{{ route('registro') }}" class="text-blue-500">Regístrate aquí</a>
        </p>
    </div>
</body>
</html>