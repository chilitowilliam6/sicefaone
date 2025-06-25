@extends('sstsena::layouts.master')

@section('content')
<h2 class="text-center mb-6 font-semibold text-2xl text-gray-800">Lista de Accidentes</h2>

<div class="flex justify-center gap-4 mb-8">
    <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="btn-primary px-5 py-3 font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300">
        Agregar Accidente
    </a>
    <button class="btn-secondary px-5 py-3 font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
        Agregar Personas Involucradas
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="agregarPersonaModal" tabindex="-1" aria-labelledby="agregarPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable rounded-lg shadow-lg bg-white">
        <div class="modal-content rounded-lg p-4">
            <div class="modal-header border-b-0 pb-2">
                <h5 class="text-primary font-semibold text-xl" id="agregarPersonaModalLabel">Crear Persona Involucrada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sstsena.funcionario.people_involved.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Tipo de Documento -->
                        <div>
                            <label for="document_type" class="block text-sm font-medium text-gray-700">Tipo de Documento</label>
                            <select name="document_type" id="document_type" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">Seleccione una opción</option>
                                <option value="CC">Cédula de Ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CE">Cédula de Extranjería</option>
                                <option value="PAS">Pasaporte</option>
                                <option value="OTRO">Otro</option>
                            </select>
                        </div>
                        <!-- Número de Documento -->
                        <div>
                            <label for="document_number" class="block text-sm font-medium text-gray-700">Número de Documento</label>
                            <input type="text" name="document_number" id="document_number" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <!-- Nombre -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <!-- Apellido -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Apellido</label>
                            <input type="text" name="last_name" id="last_name" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <!-- Fecha de Nacimiento -->
                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                            <input type="date" name="birth_date" id="birth_date" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <!-- Género -->
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700">Género</label>
                            <select name="gender" id="gender" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <!-- Tipo de Persona -->
                        <div>
                            <label for="person_type_id" class="block text-sm font-medium text-gray-700">Tipo de Persona</label>
                            <select name="person_type_id" id="person_type_id" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">Seleccione una opción</option>
                                @foreach ($typePersons as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Teléfono -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="text" name="phone" id="phone" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <!-- Dirección -->
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <input type="text" name="address" id="address" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <!-- Relación con Accidente -->
                        <div class="md:col-span-2">
                            <label for="accident_id" class="block text-sm font-medium text-gray-700">Accidente Asociado</label>
                            <select name="accident_id" id="accident_id" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">Seleccione un accidente</option>
                                @foreach ($accidents as $accident)
                                <option value="{{ $accident->id }}">
                                    {{ $accident->id . ' - ' . $accident->description }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Botón -->
                    <div class="mt-6 text-center">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 font-semibold">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabla principal -->
<div class="container mx-auto px-4 mb-10">
    <div class="overflow-x-auto rounded-xl shadow-lg bg-white border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Fecha y Hora</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Ubicación</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tipo de Lesión</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tipo de Riesgo</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tipo de Accidente</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Descripción</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Gravedad</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Evidencia</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Creado por</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700" colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($accidents as $accident)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $accident->date_time }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $accident->environment->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $accident->injuryType->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $accident->riskType->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $accident->accidentType->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $accident->description }}</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 rounded-full text-white font-medium text-sm
                            @if($accident->severity == 'Minor') bg-green-500
                            @elseif($accident->severity == 'Moderate') bg-yellow-400 text-gray-800
                            @elseif($accident->severity == 'Serious') bg-red-600
                            @elseif($accident->severity == 'Fatal') bg-gray-800
                            @endif
                        ">
                            {{ ucfirst($accident->severity) }}
                        </span>
                    </td>
                    <!-- Evidencia -->
                    <td class="px-4 py-3 text-center">
                        @if($accident->evidence)
                        @php
                        $ext = strtolower(pathinfo($accident->evidence, PATHINFO_EXTENSION));
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                        $isImage = in_array($ext, $imageExtensions);
                        $modalId = 'evidenceModal' . $accident->id;
                        @endphp
                        @if($isImage)
                        <!-- Miniatura -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                            <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" alt="Evidencia" class="w-15 h-15 object-cover rounded-lg shadow-sm hover:scale-105 transition-transform duration-200">
                        </a>
                        <!-- Modal para imagen -->
                        <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered rounded-lg shadow-lg bg-white">
                                <div class="modal-content rounded-lg p-4">
                                    <div class="flex justify-between items-center mb-4 border-b pb-2">
                                        <h5 class="text-lg font-semibold text-gray-700">Evidencia</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="text-center">
                                        <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" alt="Evidencia" class="max-h-[600px] w-auto mx-auto object-contain rounded shadow">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Archivo no imagen -->
                        <a href="{{ asset('storage/evidences/' . $accident->evidence) }}" target="_blank" class="text-blue-600 hover:underline font-medium">Ver archivo</a>
                        @endif
                        @else
                        <span class="text-gray-400 text-sm">Sin evidencia</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                    <!-- Acciones -->
                    <td class="px-2 py-3 text-center">
                        <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}" class="btn-action bg-green-500 hover:bg-green-600 text-white font-semibold px-3 py-1 rounded-lg transition duration-200 shadow-sm">Editar</a>
                    </td>
                    <td class="px-2 py-3 text-center">
                        <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este accidente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action bg-red-600 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded-lg transition duration-200 shadow-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="13" class="px-4 py-6 text-center text-gray-400 text-lg font-medium">
                        No hay accidentes registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection