@extends('sstsena::layouts.master')
@section('content')

    <div class="container mt-5">


        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <strong class="d-block mb-2">¡Ups! Algo salió mal.</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sstsena.funcionario.accidents.store') }}" method="POST" class="bg-white p-5 rounded-lg shadow"
            enctype="multipart/form-data">
            @csrf
            <center>
                <h1 class="mb-4" style="color: #1a3c6e; font-weight: 600;">Registrar Accidente</h1>
            </center>
            <div class="mb-4">
                <label for="date_time" class="form-label" style="color: #34495e; font-weight: 500;">Fecha y Hora</label>
                <input type="datetime-local" name="date_time" id="date_time" class="form-control border-light-subtle"
                    required>
            </div>

            <div class="mb-4">
                <label for="environment_id" class="form-label" style="color: #34495e; font-weight: 500;">Ubicación</label>
                <select name="environment_id" id="environment_id" class="form-select border-light-subtle" required>
                    <option value="" disabled selected>Seleccione la Ubicacion</option>
                    @foreach ($environmets as $environmet)
                        <option value="{{ $environmet->id }}">{{ $environmet->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="risk_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de
                    Riesgo</label>
                <select name="risk_type_id" id="risk_type_id" class="form-select border-light-subtle" required>
                    <option value="" disabled selected>Seleccione un tipo de riesgo</option>
                    @foreach ($riskTypes as $riskType)
                        <option value="{{ $riskType->id }}">{{ $riskType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="accident_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de
                    Accidente</label>
                <select name="accident_type_id" id="accident_type_id" class="form-select border-light-subtle" required>
                    <option value="" disabled selected>Seleccione un tipo de accidente</option>
                    @foreach ($accidentTypes as $accidentType)
                        <option value="{{ $accidentType->id }}">{{ $accidentType->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label" style="color: #34495e; font-weight: 500;">Descripción</label>
                <textarea name="description" id="description" class="form-control border-light-subtle" rows="4" required></textarea>
            </div>

            <div class="mb-4">
                <label for="evidence" class="form-label" style="color: #34495e; font-weight: 500;">Evidencia
                    (Imagen)</label>
                <input type="file" name="evidence" id="evidence" class="form-control border-light-subtle"
                    accept=".jpg,.jpeg,.png">
            </div>

            <div class="mb-4">
                <label for="severity" class="form-label" style="color: #34495e; font-weight: 500;">Gravedad</label>
                <select name="severity" id="severity" class="form-select border-light-subtle" required>
                    <option value="" disabled selected>Seleccione una Gravedad</option>
                    <option value="minor">Leve</option>
                    <option value="moderate">Moderada</option>
                    <option value="serious">Grave</option>
                    <option value="fatal">Fatal</option>
                </select>
            </div>

            <!-- Personas Involucradas -->
            <div id="personas-container">
                <label class="form-label fw-semibold">Personas Involucradas</label>

                <div class="persona-item mb-3 border p-3 rounded bg-light">
                    <div class="mb-2">
                        <label>Documento:</label>
                        <input type="text" name="personas[0][document_number]" class="form-control"
                            placeholder="Número de documento" required>
                    </div>
                    <div class="mb-2">
                        <strong>Nombre:</strong> <span class="nombre-persona text-primary"></span>
                    </div>
                    <div class="mb-2">
                        <label>Tipo de Lesión:</label>
                        <select name="personas[0][injury_type_id]" class="form-select" required>
                            <option value="">Seleccione una lesión</option>
                            @foreach ($injuryTypes as $injuryType)
                                <option value="{{ $injuryType->id }}">{{ $injuryType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Observación:</label>
                        <textarea name="personas[0][observation]" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <button type="button" id="add-persona" class="btn btn-outline-primary btn-sm mb-4">Agregar otra
                persona</button>

            <!-- Botones -->

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="btn btn-outline-secondary px-4"
                    style="border-color: #6c757d;">Cancelar</a>
                <button type="submit" class="btn btn-primary px-4"
                    style="background-color: #1a3c6e; border-color: #1a3c6e;">Registrar</button>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script>
        let personaIndex = 1;

        document.getElementById('add-persona').addEventListener('click', function() {
            const container = document.getElementById('personas-container');
            const newItem = document.createElement('div');
            newItem.classList.add('persona-item', 'mb-3', 'border', 'p-3', 'rounded', 'bg-light');
            newItem.innerHTML = `
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
