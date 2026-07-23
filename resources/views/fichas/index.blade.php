@extends('adminlte::page')

@section('title', 'Fichas')

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

.table thead th {
    background-color: #f8fff9;
    color: #2f3b46;
    font-weight: 700;
    border-bottom: 2px solid #d8e4dd;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table tbody td {
    vertical-align: middle;
    color: #495057;
    font-weight: 500;
}

.btn-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    transition: transform .2s ease, box-shadow .2s ease;
    box-shadow: 0 6px 15px rgba(25, 135, 84, 0.18);
    border-radius: 10px;
}

.btn-success:hover {
    transform: translateY(-1px);
}

.badge-level {
    font-size: 0.85rem;
    padding: 0.45em 0.85em;
    border-radius: 50rem;
    font-weight: 600;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-layer-group me-2"></i>
                    Gestión de Fichas
                </h2>
                <p class="text-muted mb-0">
                    Administre los grupos y fichas asociadas a los programas de formación.
                </p>
            </div>
            <div>
                <a href="{{ route('fichas.create') }}" class="btn btn-success px-4 py-2 font-weight-bold">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nueva Ficha
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

<div class="card card-outline card-success shadow-lg border-0">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="80" class="text-center">ID</th>
                        <th>N° Ficha</th>
                        <th>Programa de Formación</th>
                        <th>Nivel</th>
                        <th width="180" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fichas as $ficha)
                    <tr>
                        <td class="text-center font-weight-bold text-muted">
                            #{{ $ficha->id }}
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1 font-monospace">
                                <i class="fas fa-hashtag text-success mr-1"></i>
                                {{ $ficha->numero_ficha }}
                            </span>
                        </td>
                        <td>
                            <span class="font-weight-bold text-dark">
                                {{ $ficha->programa->nombre_programa ?? 'Sin Programa Asignado' }}
                            </span>
                        </td>
                        <td>
                            @php
                                $nivel = $ficha->programa->nivel_formacion ?? 'N/A';
                                $badgeClass = match($nivel) {
                                    'Tecnólogo' => 'bg-success text-white',
                                    'Técnico' => 'bg-info text-white',
                                    'Especialización' => 'bg-warning text-dark',
                                    default => 'bg-secondary text-white',
                                };
                            @endphp
                            <span class="badge badge-level {{ $badgeClass }}">
                                {{ $nivel }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('fichas.edit', $ficha) }}" 
                                   class="btn btn-outline-warning btn-sm border-0 rounded-circle mr-1"
                                   title="Editar ficha">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button" 
                                        class="btn btn-outline-danger btn-sm border-0 rounded-circle"
                                        data-toggle="modal" 
                                        data-target="#modalEliminar{{ $ficha->id }}"
                                        title="Eliminar ficha">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                            @include(
                                'partials.modal-delete',
                                [
                                    'modalId' => 'modalEliminar' . $ficha->id,
                                    'route' => route('fichas.destroy', $ficha),
                                    'message' => '¿Seguro que deseas eliminar la ficha "' . $ficha->numero_ficha . '"?'
                                ]
                            )
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 text-success opacity-50"></i>
                                <h5>No hay fichas registradas</h5>
                                <p class="small mb-0">Comienza agregando una nueva ficha usando el botón superior.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($fichas->hasPages())
            <div class="d-flex justify-content-end mt-4">
                {{ $fichas->links() }}
            </div>
        @endif
    </div>
</div>
@stop