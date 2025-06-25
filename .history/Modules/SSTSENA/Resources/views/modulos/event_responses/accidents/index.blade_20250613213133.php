@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="px-4 py-3">
                    <form id="bulk-delete-form" action="{{ route('sstsena.accidents.responses.bulkDestroy', $event->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="bulk-delete-btn" class="corporate-btn corporate-btn-delete mb-3" disabled>
                            <i class="fas fa-trash me-2"></i>
                            <span>Eliminar Seleccionados</span>
                        </button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">
                                    <input type="checkbox" id="select-all" title="Seleccionar todo">
                                </th>
                                <th>ID</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($responses as $response)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="response_ids[]" value="{{ $response->id }}" class="response-checkbox">
                                    </td>
                                    <td>{{ $response->id }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('sstsena.accidents.responses.destroy', [$event->id, $response->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="corporate-btn corporate-btn-delete">
                                                <i class="fas fa-trash"></i>
                                                <span>Eliminar</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        No se encontraron respuestas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const responseCheckboxes = document.querySelectorAll('.response-checkbox');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');

    selectAllCheckbox.addEventListener('change', function () {
        responseCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkDeleteButton();
    });

    responseCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const allChecked = Array.from(responseCheckboxes).every(cb => cb.checked);
            selectAllCheckbox.checked = allChecked;
            updateBulkDeleteButton();
        });
    });

    function updateBulkDeleteButton() {
        const someChecked = Array.from(responseCheckboxes).some(cb => cb.checked);
        bulkDeleteBtn.disabled = !someChecked;
        bulkDeleteBtn.classList.toggle('corporate-btn-disabled', !someChecked);
    }
});
</script>

<style>
.corporate-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: white;
    color: #343a40;
    border: 1.5px solid #e9ecef;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.corporate-btn:hover {
    background: #1a1a1a;
    color: white;
    border-color: #1a1a1a;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    text-decoration: none;
}

.corporate-btn-delete {
    background: #fdd7d7;
    color: #721c24;
    border-color: #f7c3c3;
}

.corporate-btn-delete:hover {
    background: #f7c3c3;
    color: #721c24;
    border-color: #f1b0b0;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
}

.corporate-btn-disabled {
    background: #e9ecef;
    color: #6c757d;
    border-color: #dee2e6;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}
</style>
@endsection