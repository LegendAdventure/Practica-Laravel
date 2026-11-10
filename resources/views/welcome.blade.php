<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Gestión de Proyectos') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles (Tailwind / Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-slate-50 text-slate-800 font-sans">
        
        <!-- Header / Navbar -->
        <!-- Header / Navbar -->
        <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                
                <!-- LOGO Y MARCA -->
                <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo ProjectManager" class="h-10 w-auto object-contain">
                    <span class="text-xl font-bold tracking-tight text-slate-900 group-hover:text-indigo-600 transition">ProjectManager</span>
                </a>

                <!-- Botones de Autenticación directos -->
                <nav class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/projects') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-500 transition">
                            Ir a Proyectos
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                            Iniciar sesión
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-500 transition">
                            Registrarse
                        </a>
                    @endauth
                </nav>
                
            </div>
        </header>

        <!-- Hero Section -->
        <section class="pt-32 pb-20 md:pt-44 md:pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl sm:text-6xl font-extrabold text-slate-900 tracking-tight max-w-4xl mx-auto leading-tight">
                    Gestión inteligente de proyectos para <span class="text-indigo-600">equipos de alto rendimiento</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Organiza tareas, asigna roles especializados, controla las horas de contribución y escala tus proyectos con total visibilidad y control.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    @auth
                        <a href="{{ url('/projects') }}" class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-white bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-500 transition">
                            Acceder a mis Proyectos
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-white bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-500 transition">
                            Empezar Gratis
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition">
                            Iniciar sesión
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 bg-white border-t border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Todo lo que tu equipo necesita</h2>
                    <p class="mt-4 text-slate-600">Diseñado bajo estándares corporativos para optimizar cada fase del flujo de trabajo.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xl mb-6">
                            👥
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Asignación de Roles</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Controla de forma granular qué rol desempeña cada miembro dentro de la estructura del proyecto mediante relaciones avanzadas.
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xl mb-6">
                            ⏱️
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Control de Horas</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Registra y audita las horas de contribución exactas de cada participante para medir el rendimiento y la dedicación.
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-xl transition duration-300">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xl mb-6">
                            🔒
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900 mb-3">Seguridad Corporativa</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Protección total de rutas y permisos de propietario para que solo los usuarios autorizados gestionen los equipos.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-slate-900 text-slate-400 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between">
                <div class="flex items-center space-x-3 mb-4 sm:mb-0">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                        P
                    </div>
                    <span class="text-white font-semibold">ProjectManager</span>
                </div>
                <p class="text-sm">
                    &copy; {{ date('Y') }} ProjectManager. Todos los derechos reservados.
                </p>
            </div>
        </footer>

    </body>
</html>