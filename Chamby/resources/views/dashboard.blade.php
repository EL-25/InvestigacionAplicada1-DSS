<!DOCTYPE html>
<html lang="es">
<head>
    <title>Dashboard - Chamby</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="p-4 bg-white shadow flex justify-between items-center fixed w-full top-0">
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

    <div class="pt-24 p-10 text-center">
        <h1 class="text-3xl font-bold">Bienvenido a la plataforma Chamby</h1>
        <p class="text-gray-600">
            @if(Auth::user()->tipo_perfil === 'empleado')
                Aquí podrás gestionar tu perfil como freelancer y buscar oportunidades de trabajo.
            @elseif(Auth::user()->tipo_perfil === 'empresa')
                Aquí podrás gestionar tu empresa y publicar ofertas de empleo para encontrar talento.
            @endif
        </p>
    </div>
</body>
</html>
