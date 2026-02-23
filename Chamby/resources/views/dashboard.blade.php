<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard - Chamby</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="p-4 bg-white shadow flex justify-between items-center fixed w-full top-0 z-10">
        <div class="text-left">
            @if(Auth::user()->tipo_perfil === 'empleado')
                <h3 class="font-bold text-lg text-blue-800">
                    {{ Auth::user()->primer_nombre }} {{ Auth::user()->primer_apellido }}
                </h3>
            @elseif(Auth::user()->tipo_perfil === 'empresa')
                <h3 class="font-bold text-lg text-blue-800">
                    {{ Auth::user()->nombre_empresa }}
                </h3>
            @endif

            <span class="text-xs uppercase bg-blue-100 text-blue-600 px-2 py-1 rounded font-semibold mt-1 inline-block">
                Perfil: {{ Auth::user()->tipo_perfil }}
            </span>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-red-500 font-bold">Cerrar Sesión</button>
        </form>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 text-white h-screen fixed left-0 top-0 pt-24">
            <ul class="space-y-4 p-4">
                <li>
                    <a href="{{ route('dashboard.editar') }}" class="block py-2 px-4 rounded hover:bg-blue-600">
                        Editar Perfil
                    </a>
                </li>
                <li>
                    <form action="{{ route('dashboard.eliminar') }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar tu cuenta?')">
                        @csrf
                        @method('DELETE')
                        <button class="block w-full text-left py-2 px-4 rounded hover:bg-red-600">
                            Eliminar Perfil
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 ml-64 p-10 pt-28">
            <h1 class="text-3xl font-bold">Bienvenido a la plataforma Chamby</h1>
            <p class="text-gray-600 mt-2">
                @if(Auth::user()->tipo_perfil === 'empleado')
                    Aquí podrás gestionar tu perfil como freelancer y buscar oportunidades de trabajo.
                @elseif(Auth::user()->tipo_perfil === 'empresa')
                    Aquí podrás gestionar tu empresa y publicar ofertas de empleo para encontrar talento.
                @endif
            </p>

            @if(session('status'))
                <div class="mt-4 bg-green-100 text-green-700 p-3 rounded">
                    {{ session('status') }}
                </div>
            @endif
        </main>
    </div>
</body>
</html>
