@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
<style>
.content-wrapper {
    background: linear-gradient(135deg, #f8fff9 0%, #f3fbf6 100%);
}

.welcome-card {
    background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%);
    border-radius: 18px;
}

.kpi-card {
    border-radius: 16px;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.kpi-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08) !important;
}

.icon-shape {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
}

.quick-action-btn {
    border-radius: 14px;
    border: 1px solid #e2ece4;
    background: #ffffff;
    transition: all 0.25s ease;
    text-decoration: none !important;
}

.quick-action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.12);
    border-color: #198754;
}

.quick-action-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.summary-card {
    border-radius: 18px;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4 welcome-card">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center">
                <div class="avatar-initial me-3 bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 1.4rem;">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <h2 class="text-success mb-1 fw-bold">
                        ¡Bienvenido, {{ auth()->user()->nombre_completo ?? auth()->user()->name }}!
                    </h2>
                    <p class="text-muted mb-0 small">
                        Sistema de Seguimiento de Bitácoras SENA — Panel de Control General
                    </p>
                </div>
            </div>
            <div>
                <span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm">
                    <i class="far fa-calendar-alt me-1"></i>
                    {{ now()->locale('es')->isoFormat('D [de] MMMM, YYYY') }}
                </span>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

<!-- KPIs de Totales -->
<div class="row">
    <!-- Aprendices -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm border-0 kpi-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small">Aprendices</span>
                        <h2 class="fw-bold text-dark mt-2 mb-0">{{ $totalAprendices }}</h2>
                    </div>
                    <div class="icon-shape bg-primary text-primary bg-opacity-10">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bitácoras -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm border-0 kpi-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small">Bitácoras</span>
                        <h2 class="fw-bold text-dark mt-2 mb-0">{{ $totalBitacoras }}</h2>
                    </div>
                    <div class="icon-shape bg-success text-success bg-opacity-10">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pendientes -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm border-0 kpi-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small">Pendientes</span>
                        <h2 class="fw-bold text-dark mt-2 mb-0">{{ $pendientes }}</h2>
                    </div>
                    <div class="icon-shape bg-warning text-warning bg-opacity-10">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seguimientos -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow-sm border-0 kpi-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small">Seguimientos</span>
                        <h2 class="fw-bold text-dark mt-2 mb-0">{{ $seguimientos }}</h2>
                    </div>
                    <div class="icon-shape bg-danger text-danger bg-opacity-10">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <!-- Accesos Rápidos -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm border-0 summary-card h-100">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="mb-0 fw-bold text-success">
                    <i class="fas fa-bolt me-2"></i>Accesos Rápidos
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('aprendices.index') }}" class="quick-action-btn p-3 d-flex flex-column align-items-center text-center h-100">
                            <div class="quick-action-icon bg-primary text-primary bg-opacity-10 mb-2">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="fw-bold text-dark">Aprendices</span>
                            <small class="text-muted mt-1">Gestión y matrículas</small>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('bitacoras.index') }}" class="quick-action-btn p-3 d-flex flex-column align-items-center text-center h-100">
                            <div class="quick-action-icon bg-success text-success bg-opacity-10 mb-2">
                                <i class="fas fa-book"></i>
                            </div>
                            <span class="fw-bold text-dark">Bitácoras</span>
                            <small class="text-muted mt-1">Revisión e informes</small>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('seguimientos.index') }}" class="quick-action-btn p-3 d-flex flex-column align-items-center text-center h-100">
                            <div class="quick-action-icon bg-warning text-warning bg-opacity-10 mb-2">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <span class="fw-bold text-dark">Seguimientos</span>
                            <small class="text-muted mt-1">Monitoreo de etapas</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen y Progreso -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm border-0 summary-card h-100">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="mb-0 fw-bold text-success">
                    <i class="fas fa-chart-pie me-2"></i>Resumen Operativo
                </h5>
            </div>
            <div class="card-body">
                @php
                    $atendidas = max(0, $totalBitacoras - $pendientes);
                    $porcentajeAvanzado = $totalBitacoras > 0 ? round(($atendidas / $totalBitacoras) * 100) : 100;
                @endphp

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold small text-muted">Atención de Bitácoras</span>
                        <span class="fw-bold text-success small">{{ $porcentajeAvanzado }}%</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 8px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                             role="progressbar" 
                             style="width: {{ $porcentajeAvanzado }}%" 
                             aria-valuenow="{{ $porcentajeAvanzado }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                        </div>
                    </div>
                </div>

                <ul class="list-group list-group-flush border-top border-bottom mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                        <span class="text-muted"><i class="fas fa-user-graduate me-2 text-primary"></i>Total Aprendices</span>
                        <span class="fw-bold">{{ $totalAprendices }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                        <span class="text-muted"><i class="fas fa-file-alt me-2 text-success"></i>Bitácoras Registradas</span>
                        <span class="fw-bold">{{ $totalBitacoras }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                        <span class="text-muted"><i class="fas fa-clock me-2 text-warning"></i>Pendientes por Revisar</span>
                        <span class="badge bg-warning text-dark rounded-pill">{{ $pendientes }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                        <span class="text-muted"><i class="fas fa-tasks me-2 text-danger"></i>Seguimientos Realizados</span>
                        <span class="fw-bold">{{ $seguimientos }}</span>
                    </li>
                </ul>

                <div class="text-center pt-2">
                    <span class="badge bg-light text-success border border-success px-3 py-2 w-100">
                        <i class="fas fa-check-circle me-1"></i> Sistema Operativo & Actualizado
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@stop