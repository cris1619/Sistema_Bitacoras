@extends('adminlte::page')

@section('title', 'Aprendices')

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

/* Badge personalizado para estados */
.badge-status {
    padding: 0.45em 0.8em;
    font-size: 0.8rem;
    font-weight: 600;
    border-radius: 8px;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-user-graduate me-2"></i>
                    Aprendices
                </h2>
                <p class="text-muted mb-0">
                    Gestión general de aprendices, fichas asignadas y seguimiento.
                </p>
            </div>
            <div>
                <a href="{{ route('aprendices.create') }}" class="btn btn-success px-4 py-2 font-weight-bold">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nuevo Aprendiz
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
                        <th>Aprendiz</th>
                        <th>Ficha</th>
                        <th>Programa</th>
                        <th class="text-center">Estado</th>
                        <th class="text-end" style="min-width: 200px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aprendices as $aprendiz)
                    <tr>
                        <td class="fw-bold text-secondary">
                            <i class="far fa-id-card me-1 text-muted"></i>
                            {{ $aprendiz->documento_identidad }}
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-initial me-3">
                                    {{ strtoupper(substr($aprendiz->nombres, 0, 1)) }}{{ strtoupper(substr($aprendiz->apellidos, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $aprendiz->nombres }} {{ $aprendiz->apellidos }}</div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1">
                                <i class="fas fa-hashtag text-success me-1"></i>
                                {{ $aprendiz->ficha->numero_ficha ?? 'N/A' }}
                            </span>
                        </td>

                        <td>
                            <span class="text-muted font-weight-500">
                                {{ $aprendiz->ficha->programa->nombre_programa ?? 'Sin programa' }}
                            </span>
                        </td>

                        <td class="text-center">
                            @php
                                $estadoNombre = strtolower($aprendiz->estado->nombre_estado ?? '');
                                $badgeClass = match(true) {
                                    str_contains($estadoNombre, 'lectiva') || str_contains($estadoNombre, 'activo') => 'bg-success text-white',
                                    str_contains($estadoNombre, 'practica') => 'bg-info text-white',
                                    str_contains($estadoNombre, 'retiro') || str_contains($estadoNombre, 'cancelado') => 'bg-danger text-white',
                                    default => 'bg-secondary text-white'
                                };
                            @endphp
                            <span class="badge badge-status {{ $badgeClass }}">
                                {{ $aprendiz->estado->nombre_estado ?? 'Indefinido' }}
                            </span>
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <!-- Ver detalles -->
                                <a href="{{ route('aprendices.show', $aprendiz) }}" 
                                   class="btn btn-action btn-outline-info" 
                                   title="Ver Detalle"
                                   data-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Dashboard -->
                                <a href="{{ route('aprendices.dashboard', $aprendiz) }}" 
                                   class="btn btn-action btn-outline-dark" 
                                   title="Dashboard Bitácoras"
                                   data-toggle="tooltip">
                                    <i class="fas fa-chart-line"></i>
                                </a>

                                <!-- Editar -->
                                <a href="{{ route('aprendices.edit', $aprendiz) }}" 
                                   class="btn btn-action btn-outline-warning" 
                                   title="Editar"
                                   data-toggle="tooltip">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <!-- Eliminar -->
                                <button type="button" 
                                        class="btn btn-action btn-outline-danger" 
                                        title="Eliminar"
                                        data-toggle="tooltip"
                                        data-toggle="modal" 
                                        data-target="#modalEliminar{{ $aprendiz->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                            @include('partials.modal-delete', [
                                'modalId' => 'modalEliminar' . $aprendiz->id,
                                'route' => route('aprendices.destroy', $aprendiz),
                                'message' => '¿Seguro que deseas eliminar al aprendiz ' . $aprendiz->nombres . ' ' . $aprendiz->apellidos . '?'
                            ])
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted mb-2">
                                <i class="fas fa-user-slash fa-3x text-light mb-3"></i>
                                <h5>No hay aprendices registrados</h5>
                                <p class="small">Comienza creando un nuevo registro con el botón superior.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($aprendices->hasPages())
            <div class="p-3 border-top d-flex justify-content-end">
                {{ $aprendices->links() }}
            </div>
        @endif
    </div>
</div>
@stop

@section('js')
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@stop