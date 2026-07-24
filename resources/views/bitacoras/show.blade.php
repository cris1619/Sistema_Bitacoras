@extends('adminlte::page')

@section('title', 'Detalle de Bitácora')

@section('css')
<style>
.content-wrapper {
    background: linear-gradient(135deg, #f8fff9 0%, #f3fbf6 100%);
}

.detail-card {
    border: 1px solid #d8e4dd;
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(25, 135, 84, 0.06);
    background: #ffffff;
    overflow: hidden;
}

.detail-header {
    background-color: #ffffff;
    border-bottom: 1px solid #e1ebe5;
    padding: 1.25rem 1.5rem;
}

.info-box-custom {
    background-color: #f8fff9;
    border: 1px solid #e1ebe5;
    border-radius: 12px;
    padding: 1rem;
    height: 100%;
}

.info-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    font-weight: 700;
    margin-bottom: 0.25rem;
    display: block;
}

.info-value {
    font-size: 1rem;
    font-weight: 600;
    color: #2f3b46;
    margin-bottom: 0;
}

.badge-status {
    font-size: 0.85rem;
    padding: 0.4em 0.8em;
    border-radius: 50rem;
    font-weight: 600;
}

.section-title {
    color: #198754;
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-custom-back {
    border-radius: 10px;
    font-weight: 600;
    padding: 0.5rem 1.25rem;
    transition: all 0.2s ease;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-file-alt me-2"></i>
                    Detalle de Bitácora #{{ $bitacora->numero_bitacora }}
                </h2>
                <p class="text-muted mb-0">
                    Información detallada y evidencia de la bitácora del aprendiz.
                </p>
            </div>
            <div>
                <a href="{{ route('bitacoras.index') }}" class="btn btn-outline-secondary btn-custom-back">
                    <i class="fas fa-arrow-left me-1"></i> Volver a la lista
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

<div class="card detail-card mb-4">
    <div class="detail-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light text-dark border px-3 py-2 font-weight-bold" style="font-size: 0.9rem;">
                Bitácora N° {{ $bitacora->numero_bitacora }}
            </span>
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
                <i class="fas fa-info-circle me-1"></i> {{ $estadoNombre }}
            </span>
        </div>

        <div>
            <a href="{{ route('bitacoras.edit', $bitacora) }}" class="btn btn-warning btn-sm fw-bold px-3" style="border-radius: 8px;">
                <i class="fas fa-edit me-1"></i> Editar Bitácora
            </a>
        </div>
    </div>

    <div class="card-body p-4">
        <!-- DATOS PRINCIPALES -->
        <h5 class="section-title">
            <i class="fas fa-user-graduate"></i> Información del Aprendiz
        </h5>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="info-box-custom">
                    <span class="info-label">Aprendiz</span>
                    <p class="info-value">
                        <i class="fas fa-user text-success me-1"></i>
                        {{ $bitacora->aprendiz->nombres }} {{ $bitacora->aprendiz->apellidos }}
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box-custom">
                    <span class="info-label">Documento</span>
                    <p class="info-value">
                        <i class="fas fa-id-card text-secondary me-1"></i>
                        {{ $bitacora->aprendiz->documento_identidad ?? 'N/A' }}
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box-custom">
                    <span class="info-label">Seguimiento Asociado</span>
                    <p class="info-value">
                        <i class="fas fa-tasks text-info me-1"></i>
                        @if($bitacora->seguimiento)
                            Seguimiento #{{ $bitacora->seguimiento->numero_seguimiento }}
                        @else
                            <span class="text-muted font-weight-normal">Sin asociar</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- FECHAS DE CONTROL -->
        <h5 class="section-title">
            <i class="fas fa-calendar-alt"></i> Control de Entrega
        </h5>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="info-box-custom">
                    <span class="info-label">Fecha Límite de Entrega</span>
                    <p class="info-value">
                        <i class="far fa-calendar-times text-danger me-1"></i>
                        {{ $bitacora->fecha_limite_entrega ? \Carbon\Carbon::parse($bitacora->fecha_limite_entrega)->format('d/m/Y') : 'Sin fecha asignada' }}
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-box-custom">
                    <span class="info-label">Fecha de Entrega Real</span>
                    <p class="info-value">
                        <i class="far fa-calendar-check text-success me-1"></i>
                        {{ $bitacora->fecha_entrega ? \Carbon\Carbon::parse($bitacora->fecha_entrega)->format('d/m/Y H:i A') : 'Aún no entregado' }}
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-4" style="border-color: #e1ebe5;">

        <!-- EVIDENCIA -->
        <h5 class="section-title">
            <i class="fas fa-paperclip"></i> Documento Evidencia
        </h5>
        <div class="mb-4">
            @if($bitacora->archivo_evidencia_url)
                <div class="p-3 border rounded-3 bg-light d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-file-pdf text-danger fa-2x"></i>
                        <div>
                            <strong class="d-block text-dark">Archivo de Evidencia Cargado</strong>
                            <span class="text-muted small">Haz clic en el botón para visualizar el documento subido por el aprendiz.</span>
                        </div>
                    </div>
                    <a href="{{ asset('storage/' . $bitacora->archivo_evidencia_url) }}"
                       target="_blank"
                       class="btn btn-success fw-bold px-3" style="border-radius: 8px;">
                        <i class="fas fa-external-link-alt me-1"></i> Ver Evidencia
                    </a>
                </div>
            @else
                <div class="p-3 border rounded-3 bg-light text-center text-muted">
                    <i class="fas fa-exclamation-circle text-warning me-1"></i>
                    No hay un archivo de evidencia cargado para esta bitácora.
                </div>
            @endif
        </div>

        <hr class="my-4" style="border-color: #e1ebe5;">

        <!-- NOVEDADES Y OBSERVACIONES -->
        <h5 class="section-title">
            <i class="fas fa-comment-dots"></i> Novedades y Observaciones
        </h5>
        <div class="p-3 border rounded-3 bg-light">
            @if($bitacora->novedades)
                <p class="mb-0 text-dark" style="white-space: pre-line;">{{ $bitacora->novedades }}</p>
            @else
                <p class="mb-0 text-muted fst-italic">Sin novedades registradas.</p>
            @endif
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('bitacoras.index') }}" class="btn btn-secondary btn-custom-back">
                <i class="fas fa-arrow-left me-1"></i> Volver a Bitácoras
            </a>
        </div>
    </div>
</div>

@stop