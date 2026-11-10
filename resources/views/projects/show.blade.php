<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alerta de éxito -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <!-- Información del proyecto -->
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-700">Descripción</h3>
                    <p class="text-gray-600 mt-1">{{ $project->description ?? 'Sin descripción' }}</p>
                    <p class="text-sm text-gray-400 mt-2">Estado: <span class="font-semibold uppercase">{{ $project->status }}</span></p>
                </div>

                <hr class="my-6">

                <!-- Listado de Miembros (CON TU DISEÑO PREFERIDO) -->
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Participantes actuales</h3>

                    @if($project->members->isEmpty())
                        <p class="text-gray-500 text-sm">Aún no hay participantes en este proyecto.</p>
                    @else
                        <ul class="divide-y divide-gray-200 bg-white shadow sm:rounded-md px-4">
                            @foreach($project->members as $member)
                                <li class="py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                    <!-- Info del usuario -->
                                    <div>
                                        <span class="font-medium text-gray-800">{{ $member->name }}</span>
                                        <span class="text-sm text-gray-500">({{ $member->email }})</span>
                                    </div>

                                    <!-- Datos de la tabla pivote y botón de eliminar -->
                                    <div class="flex items-center space-x-3">
                                        <span class="bg-indigo-100 text-indigo-800 text-xs px-2.5 py-1 rounded-full font-semibold">
                                            Rol: {{ $member->pivot->role }}
                                        </span>
                                        <span class="bg-green-100 text-green-800 text-xs px-2.5 py-1 rounded-full font-semibold">
                                            {{ $member->pivot->contribution_hours }} hrs
                                        </span>

                                        <!-- Formulario para Desvincular (Detach) -->
                                        <form action="{{ route('projects.members.destroy', [$project, $member]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de quitar a este participante del proyecto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 text-xs font-semibold px-3 py-1.5 rounded transition">
                                                Quitar
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Formulario para añadir un nuevo participante -->
                <div class="mt-8 bg-white shadow sm:rounded-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Añadir participante al proyecto</h3>

                    <form action="{{ route('projects.members.store', $project) }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- 1. Selector de Usuario -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Seleccionar Usuario</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                <option value="">-- Elige un usuario registrado --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 2. Campo para el Rol -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Rol en el proyecto</label>
                            <input type="text" name="role" id="role" placeholder="Ej. Frontend Developer, QA Tester..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('role') }}" required>
                            @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 3. Campo para las Horas de contribución -->
                        <div>
                            <label for="contribution_hours" class="block text-sm font-medium text-gray-700">Horas de contribución</label>
                            <input type="number" name="contribution_hours" id="contribution_hours" min="0" value="{{ old('contribution_hours', 0) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            @error('contribution_hours')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botón de envío -->
                        <div>
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                                Añadir Participante
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200">
                    <a href="{{ route('projects.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-sm font-semibold transition">
                        ← Volver al listado
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>