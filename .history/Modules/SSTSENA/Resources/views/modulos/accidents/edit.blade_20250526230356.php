@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <!-- Display success message if present -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #d4edda; border-color: #c3e6cb; color: #155724;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Editar Accidente</h3>
        </div>
        <div class="card-body p-4">
            <form id="accidentForm" action="{{ route('sstsena.funcionario.accidents.update', $accident->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Resto de tus campos del formulario... -->
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('sstsena.funcionario.accidents.index') }}" 
                       class="btn btn-outline-secondary px-4" 
                       style="border-color: #6c757d;">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4" 
                            style="background-color: #1a3c6e; border-color: #1a3c6e;">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('accidentForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevenir el envío inmediato
        
        // Mostrar el mensaje de confirmación
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Deseas actualizar este accidente?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1a3c6e',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, actualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si confirma, enviar el formulario
                this.submit();
                
                // Mostrar mensaje de éxito (esto se mostrará después de la redirección si el backend envía un session('success'))
                Swal.fire(
                    '¡Actualizado!',
                    'El accidente ha sido actualizado con éxito.',
                    'success'
                );
            }
        });
    });
</script>

<!-- Asegúrate de incluir SweetAlert2 en tu layout o aquí -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection