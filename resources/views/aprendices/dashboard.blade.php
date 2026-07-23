@extends('adminlte::page')

@section('title', 'Dashboard Aprendiz')

@section('css')
<style>
.content-wrapper {
    background: linear-gradient(135deg, #f8fff9 0%, #f3fbf6 100%);
}

/* Tarjetas Principales */
.card-custom {
    border-radius: 18px;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
    transition: transform 0.2s ease;
}

.card-outline.card-success {
    border-top: 4px solid #198754 !important;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(25, 135, 84, 0.08) !important;
}

.card-outline.card-info {
    border-top: 4px solid #0dcaf0 !important;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(13, 202, 240, 0.08) !important;
}

.card-outline.card-warning {
    border-top: 4px solid #ffc107 !important;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(255, 193, 7, 0.08) !important;
}

/* Small Boxes con estilo moderno */
.small-box-custom {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    padding: 1.25rem;
    color: #fff;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.small-box-custom:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

.small-box-custom .inner h3 {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 0.2rem;
}

.small-box-custom .inner p {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.small-box-custom .icon-bg {
    position: absolute;
    right: 15px;
    bottom: 10px;
    font-size: 3.5rem;
    opacity: 0.2;
}

/* Botones con gradientes */
.btn-success-gradient {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    color: #fff;
    transition: transform .2s ease, box-shadow .2s ease;
    box-shadow: 0 6px 18px rgba(25, 135, 84, 0.2);
    border-radius: 10px;
}

.btn-success-gradient:hover {
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(25, 135, 84, 0.3);
}

.btn-outline-custom {
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-outline-custom:hover {
    transform: translateY(-2px);
}

/* Avatar de iniciales del aprendiz */
.avatar-header {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: rgba(25, 135, 84, 0.12);
    color: #198754;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
}

/* Badges personalizados */
.badge-status {
    padding: 0.45em 0.85em;
    font-size: 0.78rem;
    font-weight: 600;
    border-radius: 8px;
}

/* Estilos de Tablas */
.table-custom {
    vertical-align: middle;
}

.table-custom thead {
    background-color: #f1f8f4;
    color: #2f3b46;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.table-custom th, .table-custom td {
    padding: 0.9rem 1.25rem;
    border-color: #edf3ee;
}

/* Estilo para tarjetas de bitácora */
.card-bitacora {
    border-radius: 14px;
    transition: all 0.2s ease;
}

.card-bitacora:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08) !important;
}
</style>
@stop

@section('content_header')
<!-- HEADER UNIFICADO -->
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center">
                <div class="avatar-header me-3 d-none d-sm-flex">
                    {{ strtoupper(substr($aprendice->nombres, 0, 1)) }}{{ strtoupper(substr($aprendice->apellidos, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-success mb-1 fw-bold">
                        <i class="fas fa-chart-pie me-2 d-sm-none"></i>
                        Dashboard — {{ $aprendice->nombres }} {{ $aprendice->apellidos }}
                    </h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-id-card me-1"></i> {{ $aprendice->tipo_documento }} {{ $aprendice->documento_identidad }} 
                        <span class="mx-2">•</span> 
                        <i class="fas fa-hashtag me-1"></i> Ficha: {{ $aprendice->ficha->numero_ficha ?? 'N/A' }}
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('aprendices.index') }}" class="btn btn-outline-secondary btn-outline-custom px-3 py-2">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <a href="{{ route('aprendices.show', $aprendice->id) }}" class="btn btn-success-gradient px-3 py-2 font-weight-bold">
                    <i class="fas fa-eye me-1"></i> Ver Perfil Completo
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

<!-- 1. TARJETAS DE RESUMEN (SMALL BOXES REDISEÑADOS) -->
<div class="row mb-4">
    <!-- TOTAL -->
    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
        <div class="small-box-custom" style="background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);">
            <div class="inner">
                <h3>{{ $totalBitacoras }}</h3>
                <p>Total Bitácoras</p>
            </div>
            <div class="icon-bg">
                <i class="fas fa-book"></i>
            </div>
        </div>
    </div>

    <!-- ENTREGADAS -->
    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
        <div class="small-box-custom" style="background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);">
            <div class="inner">
                <h3>{{ $entregadas }}</h3>
                <p>Entregadas</p>
            </div>
            <div class="icon-bg">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <!-- PENDIENTES -->
    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
        <div class="small-box-custom" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
            <div class="inner text-white">
                <h3>{{ $pendientes }}</h3>
                <p>Pendientes</p>
            </div>
            <div class="icon-bg">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <!-- VENCIDAS -->
    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
        <div class="small-box-custom" style="background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);">
            <div class="inner">
                <h3>{{ $vencidas }}</h3>
                <p>Vencidas</p>
            </div>
            <div class="icon-bg">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
        </div>
    </div>
</div>

<!-- 2. INFORMACIÓN Y BITÁCORAS -->
<div class="row">
    <!-- INFORMACIÓN GENERAL -->
    <div class="col-lg-4 mb-4">
        <div class="card card-outline card-success shadow-lg border-0 h-100">
            <div class="card-header bg-white py-3">
                <h5 class="card-title font-weight-bold text-success mb-0">
                    <i class="fas fa-info-circle me-2"></i>Información General
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem;">Correo Electrónico</small>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-envelope text-success me-2"></i>
                        <a href="mailto:{{ $aprendice->correo_electronico }}" class="text-dark fw-bold text-decoration-none">
                            {{ $aprendice->correo_electronico ?? 'No registrado' }}
                        </a>
                    </div>
                </div>

                <hr class="my-3" style="border-color: #f0f4f1;">

                <div class="mb-3">
                    <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem;">Teléfono de Contacto</small>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone text-success me-2"></i>
                        <span class="text-dark fw-bold">{{ $aprendice->telefono ?? 'No registrado' }}</span>
                    </div>
                </div>

                <hr class="my-3" style="border-color: #f0f4f1;">

                <div class="mb-3">
                    <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.75rem;">Empresa Patrocinadora</small>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-building text-success me-2"></i>
                        <span class="text-dark fw-bold">{{ $aprendice->empresa ?? 'Sin empresa asignada' }}</span>
                    </div>
                </div>

                <hr class="my-3" style="border-color: #f0f4f1;">

                <div class="row">
                    <div class="col-6 mb-2">
                        <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.72rem;">Inicio Práctica</small>
                        <span class="badge bg-light text-dark border px-2 py-1 w-100 text-start">
                            <i class="far fa-calendar-alt text-success me-1"></i>
                            {{ $aprendice->fecha_inicio_practica ? \Carbon\Carbon::parse($aprendice->fecha_inicio_practica)->format('d/m/Y') : 'Sin fecha' }}
                        </span>
                    </div>
                    <div class="col-6 mb-2">
                        <small class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 0.72rem;">Fin Práctica</small>
                        <span class="badge bg-light text-dark border px-2 py-1 w-100 text-start">
                            <i class="far fa-calendar-check text-success me-1"></i>
                            {{ $aprendice->fecha_fin_practica ? \Carbon\Carbon::parse($aprendice->fecha_fin_practica)->format('d/m/Y') : 'Sin fecha' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BITÁCORAS Y PROGRESO -->
    <div class="col-lg-8 mb-4">
        <!-- PROGRESO GENERAL -->
        <div class="card card-outline card-info shadow-lg border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title font-weight-bold text-info mb-0">
                    <i class="fas fa-chart-line me-2"></i>Progreso de Entregas
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold text-secondary">Porcentaje de Avance General</span>
                    <span class="badge bg-info text-white font-weight-bold px-3 py-1 fs-6" style="border-radius: 10px;">{{ $progreso }}%</span>
                </div>
                <div class="progress rounded-pill shadow-sm" style="height: 18px; background-color: #edf3ee;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated 
                        @if($progreso >= 70) bg-success 
                        @elseif($progreso >= 40) bg-warning 
                        @else bg-danger @endif" 
                        role="progressbar" 
                        style="width: {{ $progreso }}%; font-weight: bold; border-radius: 50px;" 
                        aria-valuenow="{{ $progreso }}" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>

        <!-- MÓDULOS DE BITÁCORAS -->
        <div class="card card-outline card-success shadow-lg border-0">
            <div class="card-header bg-white py-3">
                <h5 class="card-title font-weight-bold text-success mb-0">
                    <i class="fas fa-list-alt me-2"></i>Bitácoras Registradas
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($bitacoras as $bitacora)
                        @php
                            $estadoNombre = $bitacora->estado?->nombre_estado ?? 'Pendiente';
                            $esEntregada = strtolower($estadoNombre) === 'entregada';
                            $esVencida = !$esEntregada && $bitacora->fecha_limite_entrega && \Carbon\Carbon::parse($bitacora->fecha_limite_entrega)->isPast();

                            $borderStyle = $esEntregada ? 'border-success' : ($esVencida ? 'border-danger' : 'border-warning');
                            $badgeStyle = $esEntregada ? 'bg-success text-white' : ($esVencida ? 'bg-danger text-white' : 'bg-warning text-dark');
                        @endphp

                        <div class="col-sm-6 col-md-4 mb-3">
                            <div class="card card-bitacora {{ $borderStyle }} h-100 border shadow-sm">
                                <div class="card-body p-3 text-center d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="text-muted small fw-bold mb-1">REGISTRO</div>
                                        <h5 class="font-weight-bold mb-2 text-dark">
                                            Bitácora #{{ $bitacora->numero_bitacora }}
                                        </h5>
                                        <span class="badge badge-status {{ $badgeStyle }} mb-3">
                                            {{ $esVencida && !$esEntregada ? 'Vencida' : $estadoNombre }}
                                        </span>
                                        <p class="small text-muted mb-3">
                                            <i class="far fa-clock me-1 text-secondary"></i> 
                                            Límite: {{ $bitacora->fecha_limite_entrega ? \Carbon\Carbon::parse($bitacora->fecha_limite_entrega)->format('d/m/Y') : 'Sin fecha' }}
                                        </p>
                                    </div>
                                    <div>
                                        <a href="{{ route('bitacoras.show', $bitacora->id) }}" class="btn btn-sm btn-outline-success btn-outline-custom w-100">
                                            <i class="fas fa-eye me-1"></i> Ver Detalle
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                                <h6>No se han registrado bitácoras para este aprendiz.</h6>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3. SEGUIMIENTOS -->
<div class="card card-outline card-warning shadow-lg border-0 mb-4">
    <div class="card-header bg-white py-3">
        <h5 class="card-title font-weight-bold text-warning mb-0">
            <i class="fas fa-tasks me-2"></i>Seguimientos Programados
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-custom mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 140px;">N° Seguimiento</th>
                        <th>Fecha Programada</th>
                        <th class="text-center">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($seguimientos as $seguimiento)
                        <tr>
                            <td class="text-center font-weight-bold text-secondary">
                                <i class="fas fa-hashtag text-warning me-1"></i>
                                {{ $seguimiento->numero_seguimiento }}
                            </td>
                            <td class="fw-bold text-dark">
                                <i class="far fa-calendar-alt me-2 text-muted"></i>
                                {{ $seguimiento->fecha_programada ? \Carbon\Carbon::parse($seguimiento->fecha_programada)->format('d/m/Y') : 'Sin fecha' }}
                            </td>
                            <td class="text-center">
                                @php
                                    $estadoSeg = strtolower($seguimiento->estado?->nombre_estado ?? 'pendiente');
                                    $badgeSeg = match(true) {
                                        str_contains($estadoSeg, 'realizado') || str_contains($estadoSeg, 'completado') => 'bg-success text-white',
                                        str_contains($estadoSeg, 'cancelado') => 'bg-danger text-white',
                                        default => 'bg-warning text-dark'
                                    };
                                @endphp
                                <span class="badge badge-status {{ $badgeSeg }}">
                                    {{ $seguimiento->estado?->nombre_estado ?? 'Pendiente' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                <i class="fas fa-info-circle me-1"></i> No hay seguimientos programados registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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