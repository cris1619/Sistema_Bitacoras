@extends('adminlte::page')

@section('title', 'Instructores')

@section('css')
<style>
.content-wrapper {
    background: linear-gradient(135deg, #f8fff9 0%, #f3fbf6 100%);
}

.card-outline.card-success {
    border-top: 4px solid #198754 !important;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(25, 135, 84, 0.08) !important;
}

.table-custom {
    vertical-align: middle;
}

.table-custom thead {
    background-color: #f1f8f4;
    color: #2f3b46;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.82rem;
    letter-spacing: 0.5px;
}

.table-custom th, .table-custom td {
    padding: 1rem 1.25rem;
    border-color: #edf3ee;
}

.avatar-initial {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
}

.btn-action {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-action:hover {
    transform: translateY(-2px);
}

.btn-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    transition: transform .2s ease, box-shadow .2s ease;
    box-shadow: 0 6px 18px rgba(25, 135, 84, 0.2);
    border-radius: 10px;
}

.btn-success:hover {
    transform: translateY(-1px);
}

.badge-program {
    padding: 0.45em 0.75em;
    font-size: 0.78rem;
    font-weight: 600;
    border-radius: 8px;
    background-color: #e8f5e9;
    color: #1b5e20;
    border: 1px solid #c8e6c9;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    Instructores
                </h2>
                <p class="text-muted mb-0">
                    Gestión general de instructores, asignación de programas de formación y seguimiento.
                </p>
            </div>
            <div>
                <a href="{{ route('instructores.create') }}" class="btn btn-success px-4 py-2 font-weight-bold">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nuevo Instructor
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

<div class="card card-outline card-success shadow-lg border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-custom mb-0">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Instructor</th>
                        <th>Correo Electrónico</th>
                        <th>Programas</th>
                        <th class="text-end" style="min-width: 160px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($instructores as $instructor)
                    <tr>
                        <td class="fw-bold text-secondary">
                            <i class="far fa-id-card me-1 text-muted"></i>
                            {{ $instructor->documento_identidad }}
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-initial me-3">
                                    @php
                                        $nombre = $instructor->nombres ?? $instructor->nombre_completo ?? 'I';
                                        $apellido = $instructor->apellidos ?? '';
                                        $iniciales = strtoupper(substr($nombre, 0, 1)) . ($apellido ? strtoupper(substr($apellido, 0, 1)) : '');
                                    @endphp
                                    {{ $iniciales }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">
                                        {{ $instructor->nombre_completo ?? ($instructor->nombres . ' ' . $instructor->apellidos) }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="text-muted font-weight-500">
                                <i class="far fa-envelope me-1 text-success"></i>
                                {{ $instructor->correo_electronico }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @forelse($instructor->programas as $programa)
                                    <span class="badge badge-program">
                                        <i class="fas fa-book me-1"></i>
                                        {{ $programa->nombre_programa }}
                                    </span>
                                @empty
                                    <span class="badge bg-light text-muted border px-2 py-1">
                                        Sin programas asignados
                                    </span>
                                @endforelse
                            </div>
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <!-- Ver detalles -->
                                <a href="{{ route('instructores.show', $instructor) }}" 
                                   class="btn btn-action btn-outline-info" 
                                   title="Ver Detalle"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('instructores.edit', $instructor) }}" 
                                   class="btn btn-action btn-outline-warning" 
                                   title="Editar"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <!-- Eliminar (Disparador del Modal) -->
                                <button type="button" 
                                        class="btn btn-action btn-outline-danger" 
                                        title="Eliminar"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalEliminar{{ $instructor->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted mb-2">
                                <i class="fas fa-user-slash fa-3x text-light mb-3"></i>
                                <h5>No hay instructores registrados</h5>
                                <p class="small">Comienza creando un nuevo registro con el botón superior.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($instructores->hasPages())
            <div class="p-3 border-top d-flex justify-content-end">
                {{ $instructores->links() }}
            </div>
        @endif
    </div>
</div>

{{-- Renderizado de Modales fuera del flujo de la tabla --}}
@foreach($instructores as $instructor)
    @include('partials.modal-delete', [
        'modalId' => 'modalEliminar' . $instructor->id,
        'route' => route('instructores.destroy', $instructor),
        'message' => '¿Seguro que deseas eliminar al instructor ' . ($instructor->nombre_completo ?? $instructor->nombres) . '?'
    ])
@endforeach

@stop

@section('js')
<script>
$(function () {
    // Inicializar tooltips (Soporte genérico)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"], [data-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@stop