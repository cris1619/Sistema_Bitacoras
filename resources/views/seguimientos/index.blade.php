@extends('adminlte::page')

@section('title', 'Seguimientos')

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

.badge-num {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
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
                    <i class="fas fa-clipboard-list me-2"></i>
                    Control de Seguimientos
                </h2>
                <p class="text-muted mb-0">
                    Gestión y monitoreo de las etapas de seguimiento para aprendices e instructores.
                </p>
            </div>
            <div>
                <a href="{{ route('seguimientos.create') }}" class="btn btn-success px-4 py-2 font-weight-bold">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nuevo Seguimiento
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
                        <th class="text-center" style="width: 70px;">#</th>
                        <th>Aprendiz</th>
                        <th>Instructor</th>
                        <th>Estado</th>
                        <th>Fecha Programada</th>
                        <th class="text-end" style="min-width: 150px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($seguimientos as $seguimiento)
                    <tr>
                        <td class="text-center">
                            <span class="badge-num">
                                {{ $seguimiento->numero_seguimiento }}
                            </span>
                        </td>

                        <td>
                            <div class="fw-bold text-dark">
                                <i class="fas fa-user-graduate text-success me-1"></i>
                                {{ optional($seguimiento->aprendiz)->nombres }} {{ optional($seguimiento->aprendiz)->apellidos }}
                            </div>
                        </td>

                        <td class="text-secondary font-weight-500">
                            <i class="fas fa-chalkboard-teacher me-1 text-muted"></i>
                            {{ optional($seguimiento->instructor)->nombre_completo ?? 'Sin asignar' }}
                        </td>

                        <td>
                            @php
                                $estadoNombre = optional($seguimiento->estado)->nombre_estado ?? 'Pendiente';
                                switch(strtolower($estadoNombre)) {
                                    case 'aprobado':
                                    case 'finalizado':
                                        $bgClass = 'bg-success';
                                        break;
                                    case 'en proceso':
                                    case 'programado':
                                        $bgClass = 'bg-info';
                                        break;
                                    case 'cancelado':
                                    case 'rechazado':
                                        $bgClass = 'bg-danger';
                                        break;
                                    default:
                                        $bgClass = 'bg-warning text-dark';
                                }
                            @endphp
                            <span class="badge badge-status {{ $bgClass }} text-white">
                                {{ $estadoNombre }}
                            </span>
                        </td>

                        <td class="text-secondary">
                            <i class="far fa-calendar-alt me-1 text-muted"></i>
                            {{ \Carbon\Carbon::parse($seguimiento->fecha_programada)->format('d/m/Y') }}
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                {{-- Ver detalles --}}
                                <a href="{{ route('seguimientos.show', $seguimiento) }}" 
                                   class="btn btn-action btn-outline-info" 
                                   title="Ver detalles"
                                   data-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Editar --}}
                                <a href="{{ route('seguimientos.edit', $seguimiento) }}" 
                                   class="btn btn-action btn-outline-warning" 
                                   title="Editar seguimiento"
                                   data-toggle="tooltip">
                                    <i class="fas fa-pen"></i>
                                </a>

                                {{-- Eliminar --}}
                                <button type="button" 
                                        class="btn btn-action btn-outline-danger" 
                                        data-toggle="modal" 
                                        data-target="#modalEliminar{{ $seguimiento->id }}"
                                        title="Eliminar seguimiento">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                @include('partials.modal-delete', [
                                    'modalId' => 'modalEliminar' . $seguimiento->id,
                                    'route'   => route('seguimientos.destroy', $seguimiento),
                                    'message' => '¿Seguro que deseas eliminar este seguimiento? Esta acción no se puede deshacer.'
                                ])
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted mb-2">
                                <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                                <h5>No hay seguimientos registrados</h5>
                                <p class="small">Comienza programando un nuevo seguimiento con el botón superior.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($seguimientos->hasPages())
            <div class="p-3 border-top d-flex justify-content-end">
                {{ $seguimientos->links() }}
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