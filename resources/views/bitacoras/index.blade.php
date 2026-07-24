@extends('adminlte::page')

@section('title', 'Gestión de Bitácoras')

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

.search-card {
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #d8e4dd;
    box-shadow: 0 4px 15px rgba(25, 135, 84, 0.05);
}

.search-input {
    border-radius: 10px;
    border: 1px solid #ced4da;
    padding-left: 2.5rem;
    height: 45px;
    transition: all 0.25s ease;
}

.search-input:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
}

.search-icon {
    position: absolute;
    left: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    color: #198754;
}

.aprendiz-card {
    border-radius: 14px !important;
    border: 1px solid #e1ebe5;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    margin-bottom: 1rem;
    overflow: hidden;
    transition: all 0.25s ease;
}

.aprendiz-card:hover {
    border-color: #198754;
}

.aprendiz-card .card-header {
    background-color: #ffffff;
    border-bottom: 1px solid #f0f0f0;
    padding: 1rem 1.25rem;
}

.btn-toggle-collapse {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.table thead th {
    background-color: #f8fff9;
    color: #2f3b46;
    font-weight: 700;
    border-bottom: 2px solid #d8e4dd;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.table tbody td {
    vertical-align: middle;
    color: #495057;
    font-weight: 500;
}

.badge-status {
    font-size: 0.8rem;
    padding: 0.4em 0.75em;
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
                    <i class="fas fa-book-reader me-2"></i>
                    Gestión de Bitácoras
                </h2>
                <p class="text-muted mb-0">
                    Consulta, seguimiento y control de bitácoras registradas por aprendiz.
                </p>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

<!-- Buscador Principal -->
<div class="card search-card mb-4">
    <div class="card-body p-3">
        <div class="position-relative">
            <i class="fas fa-search search-icon"></i>
            <input type="text"
                   id="buscadorAprendiz"
                   class="form-control search-input"
                   placeholder="Buscar aprendiz por nombre, apellido o número de documento...">
        </div>
    </div>
</div>

<!-- Acordeón de Aprendices -->
<div class="accordion" id="accordionBitacoras">
    @forelse($aprendices as $aprendiz)
        <div class="card aprendiz-card">
            <div class="card-header"
                 data-search="{{ strtolower($aprendiz->nombres) }} {{ strtolower($aprendiz->apellidos) }} {{ strtolower($aprendiz->documento_identidad) }}">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                    <div>
                        <h5 class="mb-1 font-weight-bold text-dark">
                            <i class="fas fa-user-circle text-success me-1"></i>
                            {{ $aprendiz->nombres }} {{ $aprendiz->apellidos }}
                        </h5>
                        <div class="text-muted small">
                            <span class="me-2"><i class="fas fa-id-card text-secondary me-1"></i><strong>Doc:</strong> {{ $aprendiz->documento_identidad }}</span>
                            <span class="me-2">|</span>
                            <span class="me-2"><i class="fas fa-layer-group text-secondary me-1"></i><strong>Ficha:</strong> {{ $aprendiz->ficha->numero_ficha ?? 'N/A' }}</span>
                            <span class="me-2">-</span>
                            <span>{{ $aprendiz->ficha?->programa?->nombre_programa ?? 'Sin programa' }}</span>
                        </div>
                    </div>

                    <button class="btn btn-outline-success btn-sm btn-toggle-collapse mt-2 mt-md-0"
                            type="button"
                            data-toggle="collapse"
                            data-target="#collapse{{ $aprendiz->id }}">
                        <i class="fas fa-list-ol me-1"></i> Ver Bitácoras ({{ $aprendiz->bitacoras->count() }})
                    </button>
                </div>
            </div>

            <div id="collapse{{ $aprendiz->id }}"
                 class="collapse"
                 data-parent="#accordionBitacoras">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th width="120" class="text-center">N° Bitácora</th>
                                    <th>Estado</th>
                                    <th>Fecha Límite</th>
                                    <th>Archivo Evidencia</th>
                                    <th width="160" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($aprendiz->bitacoras as $bitacora)
                                    <tr>
                                        <td class="text-center font-weight-bold">
                                            <span class="badge bg-light text-dark border px-2 py-1">
                                                Bitácora #{{ $bitacora->numero_bitacora }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $estadoNombre = $bitacora->estado?->nombre_estado ?? 'Pendiente';
                                                $badgeClass = match(strtolower($estadoNombre)) {
                                                    'aprobado', 'aprobada' => 'bg-success text-white',
                                                    'no aprobado', 'corregir' => 'bg-danger text-white',
                                                    'enviado', 'entregado' => 'bg-info text-white',
                                                    default => 'bg-warning text-dark',
                                                };
                                            @endphp
                                            <span class="badge badge-status {{ $badgeClass }}">
                                                {{ $estadoNombre }}
                                            </span>
                                        </td>
                                        <td>
                                            <i class="far fa-calendar-alt text-muted me-1"></i>
                                            {{ $bitacora->fecha_limite_entrega ? \Carbon\Carbon::parse($bitacora->fecha_limite_entrega)->format('d/m/Y') : 'Sin fecha' }}
                                        </td>
                                        <td>
                                            @if($bitacora->archivo_evidencia_url)
                                                <a href="{{ asset('storage/' . $bitacora->archivo_evidencia_url) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-success border-0 fw-bold">
                                                    <i class="fas fa-file-pdf me-1"></i> Ver Documento
                                                </a>
                                            @else
                                                <span class="text-muted small fst-italic">
                                                    <i class="fas fa-exclamation-circle me-1"></i> Sin archivo
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('bitacoras.show', $bitacora) }}"
                                                   class="btn btn-outline-info btn-sm border-0 rounded-circle mr-1"
                                                   title="Ver detalle">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('bitacoras.edit', $bitacora) }}"
                                                   class="btn btn-outline-warning btn-sm border-0 rounded-circle"
                                                   title="Editar bitácora">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-folder-open mb-2 fa-2x opacity-50 d-block"></i>
                                            Este aprendiz no tiene bitácoras registradas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="card aprendiz-card p-5 text-center text-muted">
            <i class="fas fa-users-slash fa-3x text-success opacity-50 mb-3"></i>
            <h5>No hay aprendices registrados</h5>
            <p class="small mb-0">No se encontraron registros de aprendices con bitácoras asignadas.</p>
        </div>
    @endforelse
</div>

@if($aprendices->hasPages())
    <div class="d-flex justify-content-end mt-4">
        {{ $aprendices->links() }}
    </div>
@endif

@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buscador = document.getElementById('buscadorAprendiz');

    buscador.addEventListener('keyup', function () {
        let valor = this.value.toLowerCase().trim();
        let cards = document.querySelectorAll('.aprendiz-card');

        cards.forEach(card => {
            let header = card.querySelector('.card-header');
            if (header) {
                let texto = header.dataset.search || '';
                if (texto.includes(valor)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    });
});
</script>
@stop