<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Proyecto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Mostrar errores de validación si los hay -->
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulario apuntando a la ruta 'projects.store' por método POST -->
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold mb-2">Título del Proyecto:</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold mb-2">Descripción:</label>
                            <textarea name="description" id="description" rows="4" 
                                      class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Guardar Proyecto
                            </button>
                            <a href="{{ route('projects.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
                        </div>
                    </form> <!-- AQUÍ SE CIERRA EL FORMULARIO CORRECTAMENTE -->

                    <!-- Este bloque estaba dentro del form. Ahora está fuera, donde corresponde -->
                    <div class="flex justify-between items-center mb-6 mt-6">
                        <h3 class="text-lg font-bold">Mis Proyectos</h3>
                        <a href="{{ route('projects.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            + Nuevo Proyecto
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>