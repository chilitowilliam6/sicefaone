@extends('sstsena::layouts.master')

@section('content')
    <div class="container mt-5">
        <!-- Display success message if present -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="background-color: #d4edda; border-color: #c3e6cb; color: #155724;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
            <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Editar Accidente</h3>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('sstsena.funcionario.accidents.update', $accident->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="date_time" class="form-label" style="color: #34495e; font-weight: 500;">Fecha y
                            Hora</label>
                        <input type="datetime-local" name="date_time" id="date_time"
                            class="form-control border-light-subtle" value="{{ $accident->date_time }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="environment_id" class="form-label"
                            style="color: #34495e; font-weight: 500;">Entorno</label>
                        <select name="environment_id" id="environment_id" class="form-select border-light-subtle" required>
                            @foreach ($environments as $environment)
                                <option value="{{ $environment->id }}"
                                    {{ $accident->environment_id == $environment->id ? 'selected' : '' }}>
                                    {{ $environment->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="risk_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de
                            Riesgo</label>
                        <select name="risk_type_id" id="risk_type_id" class="form-select border-light-subtle" required>
                            @foreach ($riskTypes as $riskType)
                                <option value="{{ $riskType->id }}"
                                    {{ $accident->risk_type_id == $riskType->id ? 'selected' : '' }}>
                                    {{ $riskType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="accident_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de
                            Accidente</label>
                        <select name="accident_type_id" id="accident_type_id" class="form-select border-light-subtle"
                            required>
                            @foreach ($accidentTypes as $accidentType)
                                <option value="{{ $accidentType->id }}"
                                    {{ $accident->accident_type_id == $accidentType->id ? 'selected' : '' }}>
                                    {{ $accidentType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label"
                            style="color: #34495e; font-weight: 500;">Descripción</label>
                        <textarea name="description" id="description" class="form-control border-light-subtle" rows="4">{{ $accident->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="evidence" class="form-label">Evidencia</label>
                        <input type="file" name="evidence" id="evidence" class="form-control">

                        @if ($accident->evidence)
                            <div class="mt-3">
                                <label class="form-label">Vista previa actual:</label>
                                <div class="border p-2 rounded" style="max-width: 200px;">
                                    <!-- Botón que abre el modal -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#evidenceModal">
                                        <img src="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                            alt="Evidencia actual" class="img-fluid rounded"
                                            style="max-height: 150px; object-fit: cover;">
                                    </a>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="evidenceModalLabel">Evidencia</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                                alt="Evidencia actual" class="img-fluid rounded"
                                                style="max-block-size: 600px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="severity" class="form-label"
                            style="color: #34495e; font-weight: 500;">Gravedad</label>
                        <select name="severity" id="severity" class="form-select border-light-subtle" required>
                            <option value="minor" {{ $accident->severity == 'minor' ? 'selected' : '' }}>Leve</option>
                            <option value="moderate" {{ $accident->severity == 'moderate' ? 'selected' : '' }}>Moderada
                            </option>
                            <option value="serious" {{ $accident->severity == 'serious' ? 'selected' : '' }}>Grave
                            </option>
                            <option value="fatal" {{ $accident->severity == 'fatal' ? 'selected' : '' }}>Fatal</option>
                        </select>
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3">Personas Afectadas</h5>

                    <!-- Personas ya asociadas -->
                    @foreach ($accident->accidentPersons as $index => $personaAccidente)
                        <div class="border p-3 mb-4 rounded position-relative">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2"
                                onclick="removePersonBlock(this)" title="Eliminar persona del accidente">
                            </button>
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control"
                                    value="{{ $personaAccidente->person->full_name ?? $personaAccidente->person->name }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Número de Documento</label>
                                <input type="text" name="personas[{{ $index }}][document_number]"
                                    class="form-control" value="{{ $personaAccidente->person->document_number }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tipo de Lesión</label>
                                <select name="personas[{{ $index }}][injury_type_id]" class="form-select"
                                    required>
                                    @foreach ($injuryTypes as $injuryType)
                                        <option value="{{ $injuryType->id }}"
                                            {{ $personaAccidente->injury_type_id == $injuryType->id ? 'selected' : '' }}>
                                            {{ $injuryType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Observación</label>
                                <textarea name="personas[{{ $index }}][observation]" class="form-control" rows="2">{{ $personaAccidente->observation }}</textarea>
                            </div>
                        </div>
                    @endforeach

                    <!-- Contenedor de nuevas personas -->
                    <div id="personas-container-edit"></div>

                    <!-- Botón para agregar persona -->
                    <button type="button" id="add-persona" class="btn btn-outline-primary btn-sm mb-4">Agregar otra
                        persona</button>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('sstsena.funcionario.accidents.index') }}"
                            class="btn btn-outline-secondary px-4" style="border-color: #6c757d;">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4"
                            style="background-color: #1a3c6e; border-color: #1a3c6e;">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function removePersonBlock(button) {
            const container = button.closest('.border.p-3');
            if (container) container.remove();
        }

        let personaIndex = {{ count($accident->accidentPersons) }};

        document.getElementById('add-persona').addEventListener('click', function() {
            const container = document.getElementById('personas-container-edit');
            const newItem = document.createElement('div');
            newItem.classList.add('persona-item', 'mb-3', 'border', 'p-3', 'rounded', 'bg-light',
                'position-relative');

            newItem.innerHTML = `
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2"
                onclick="this.closest('.persona-item').remove()" title="Eliminar persona"></button>
            <div class="mb-2">
                <label>Documento:</label>
                <input type="text" name="personas[${personaIndex}][document_number]" class="form-control" placeholder="Número de documento" required>
            </div>
            <div class="mb-2">
                <strong>Nombre:</strong> <span class="nombre-persona text-primary"></span>
            </div>
            <div class="mb-2">
                <label>Tipo de Lesión:</label>
                <select name="personas[${personaIndex}][injury_type_id]" class="form-select" required>
                    <option value="">Seleccione una lesión</option>
                    @foreach ($injuryTypes as $injuryType)
                        <option value="{{ $injuryType->id }}">{{ $injuryType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label>Observación:</label>
                <textarea name="personas[${personaIndex}][observation]" class="form-control" rows="2"></textarea>
            </div>
        `;

            container.appendChild(newItem);
            personaIndex++;
        });

        document.addEventListener('input', function(e) {
            if (e.target && e.target.name.includes('[document_number]')) {
                const input = e.target;
                const container = input.closest('.persona-item');
                const nombreSpan = container.querySelector('.nombre-persona');

                if (input.value.length >= 5) {
                    fetch(`/accidents/buscarPorDocumento?documento=${input.value}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                nombreSpan.textContent =
                                    `${data.persona.nombre} ${data.persona.apellido1} ${data.persona.apellido2 ?? ''} ` +
                                    ' - ' + `${data.persona.cargo}`;
                                nombreSpan.classList.remove('text-danger');
                                nombreSpan.classList.add('text-primary');
                            } else {
                                nombreSpan.textContent = 'Persona no encontrada';
                                nombreSpan.classList.remove('text-primary');
                                nombreSpan.classList.add('text-danger');
                            }
                        })
                        .catch(err => {
                            nombreSpan.textContent = 'Error consultando';
                            nombreSpan.classList.add('text-danger');
                        });
                } else {
                    nombreSpan.textContent = '';
                }
            }
        });
    </script>
@endsection
