@extends('adminlte::page')

@section('title', 'Detalle del Seguimiento')

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

.nav-tabs-custom {
    border-bottom: 2px solid #e9ecef;
    background: #f8f9fa;
    padding: 0.5rem 0.5rem 0 0.5rem;
    border-radius: 18px 18px 0 0;
}

.nav-tabs-custom .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 600;
    padding: 0.8rem 1.25rem;
    border-radius: 10px 10px 0 0;
    transition: all 0.25s ease;
    margin-right: 0.25rem;
}

.nav-tabs-custom .nav-link:hover {
    color: #198754;
    background: rgba(25, 135, 84, 0.05);
}

.nav-tabs-custom .nav-link.active {
    color: #198754;
    background: #ffffff;
    border-bottom: 3px solid #198754;
    font-weight: 700;
}

.info-label {
    font-size: 0.85rem;
    font-weight: 700;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.3rem;
}

.info-value {
    font-size: 1.05rem;
    font-weight: 600;
    color: #2f3b46;
}

.detail-box {
    background: #ffffff;
    border: 1px solid #d8e4dd;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    height: 100%;
    transition: all 0.25s ease;
}

.detail-box:hover {
    border-color: #198754;
    box-shadow: 0 4px 15px rgba(25, 135, 84, 0.06);
}

.badge-custom {
    font-size: 0.9rem;
    padding: 0.4em 0.8em;
    border-radius: 8px;
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
                    <i class="fas fa-clipboard-check me-2"></i>
                    Seguimiento #{{ $seguimiento->numero_seguimiento ?? 'N/A' }}
                </h2>
                <p class="text-muted mb-0">
                    <i class="fas fa-user-graduate me-1"></i> Aprendiz: 
                    <strong>{{ $seguimiento->aprendiz?->nombres }} {{ $seguimiento->aprendiz?->apellidos }}</strong>
                </p>
            </div>
            <div class="d-flex gap-2">
                @if(Route::has('seguimientos.edit'))
                    <a href="{{ route('seguimientos.edit', $seguimiento->id) }}" class="btn btn-warning px-4 py-2 text-white font-weight-bold" style="border-radius: 10px;">
                        <i class="fas fa-edit me-2"></i>
                        Editar
                    </a>
                @endif
                <a href="{{ route('seguimientos.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

<div class="card card-outline card-success shadow-lg border-0 mb-5">
    
    <!-- Pestañas de Navegación -->
    <ul class="nav nav-tabs nav-tabs-custom" id="seguimientoShowTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="general-tab" data-toggle="tab" data-target="#general" type="button" role="tab">
                <i class="fas fa-info-circle me-2"></i>Información General
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="desarrollo-tab" data-toggle="tab" data-target="#desarrollo" type="button" role="tab">
                <i class="fas fa-tasks me-2"></i>Observaciones y Compromisos
            </button>
        </li>
    </ul>

    <div class="card-body p-4">
        <div class="tab-content" id="seguimientoShowTabContent">
            
            <!-- TAB 1: INFORMACIÓN GENERAL -->
            <div class="tab-pane fade show active" id="general" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-user-graduate text-success me-1"></i> Aprendiz</span>
                            <div class="info-value">
                                {{ $seguimiento->aprendiz?->nombres }} {{ $seguimiento->aprendiz?->apellidos }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-user-tie text-success me-1"></i> Instructor a Cargo</span>
                            <div class="info-value">
                                {{ $seguimiento->instructor?->nombre_completo ?? 'No asignado' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-hashtag text-success me-1"></i> Número de Seguimiento</span>
                            <span class="badge badge-info badge-custom">
                                {{ $seguimiento->numero_seguimiento ?? 'S/N' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-toggle-on text-success me-1"></i> Estado</span>
                            <span class="badge badge-success badge-custom">
                                {{ $seguimiento->estado?->nombre_estado ?? 'Sin Estado' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="far fa-calendar-alt text-success me-1"></i> Fecha Programada</span>
                            <div class="info-value">
                                {{ $seguimiento->fecha_programada ? \Carbon\Carbon::parse($seguimiento->fecha_programada)->format('d/m/Y') : 'Sin fecha' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="far fa-calendar-check text-success me-1"></i> Fecha Realizada</span>
                            <div class="info-value">
                                {{ $seguimiento->fecha_realizada ? \Carbon\Carbon::parse($seguimiento->fecha_realizada)->format('d/m/Y') : 'Pendiente' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: OBSERVACIONES Y COMPROMISOS -->
            <div class="tab-pane fade" id="desarrollo" role="tabpanel">
                <div class="row g-3">
                    <div class="col-12 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block mb-2"><i class="fas fa-comment-dots text-success me-1"></i> Observaciones</span>
                            <p class="mb-0 text-secondary" style="white-space: pre-line; line-height: 1.6;">
                                {{ $seguimiento->observaciones ?? 'Sin observaciones registradas.' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block mb-2"><i class="fas fa-handshake text-success me-1"></i> Compromisos</span>
                            <p class="mb-0 text-secondary" style="white-space: pre-line; line-height: 1.6;">
                                {{ $seguimiento->compromisos ?? 'Sin compromisos registrados.' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block mb-2"><i class="fas fa-lightbulb text-success me-1"></i> Recomendaciones</span>
                            <p class="mb-0 text-secondary" style="white-space: pre-line; line-height: 1.6;">
                                {{ $seguimiento->recomendaciones ?? 'Sin recomendaciones registradas.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@stop