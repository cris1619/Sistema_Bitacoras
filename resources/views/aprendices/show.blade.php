@extends('adminlte::page')

@section('title', 'Detalle del Aprendiz')

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
                    <i class="fas fa-user-graduate me-2"></i>
                    {{ $aprendice->nombres }} {{ $aprendice->apellidos }}
                </h2>
                <p class="text-muted mb-0">
                    <i class="fas fa-id-card me-1"></i> {{ $aprendice->tipo_documento }}: <strong>{{ $aprendice->documento_identidad }}</strong>
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('aprendices.edit', $aprendice->id) }}" class="btn btn-warning px-4 py-2 text-white font-weight-bold" style="border-radius: 10px;">
                    <i class="fas fa-edit me-2"></i>
                    Editar
                </a>
                <a href="{{ route('aprendices.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
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
    <ul class="nav nav-tabs nav-tabs-custom" id="aprendizShowTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="academica-tab" data-toggle="tab" data-target="#academica" type="button" role="tab">
                <i class="fas fa-graduation-cap me-2"></i>Información Académica
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="personal-tab" data-toggle="tab" data-target="#personal" type="button" role="tab">
                <i class="fas fa-id-card me-2"></i>Información Personal
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="empresa-tab" data-toggle="tab" data-target="#empresa" type="button" role="tab">
                <i class="fas fa-building me-2"></i>Información Empresa
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="productiva-tab" data-toggle="tab" data-target="#productiva" type="button" role="tab">
                <i class="fas fa-briefcase me-2"></i>Etapa Productiva
            </button>
        </li>
    </ul>

    <div class="card-body p-4">
        <div class="tab-content" id="aprendizShowTabContent">
            
            <!-- TAB 1: INFORMACIÓN ACADÉMICA -->
            <div class="tab-pane fade show active" id="academica" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-4 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-layer-group text-success me-1"></i> Ficha</span>
                            <span class="badge badge-info badge-custom">
                                {{ $aprendice->ficha?->numero_ficha ?? 'Sin Ficha' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-8 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-book text-success me-1"></i> Programa de Formación</span>
                            <div class="info-value">{{ $aprendice->ficha?->programa?->nombre_programa ?? 'Sin programa asignado' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-info-circle text-success me-1"></i> Estado</span>
                            <span class="badge badge-success badge-custom">
                                {{ $aprendice->estado?->nombre_estado ?? 'No definido' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-link text-success me-1"></i> Vínculo Formativo</span>
                            <span class="badge badge-secondary badge-custom">
                                {{ $aprendice->vinculo?->nombre_vinculo ?? 'No definido' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: INFORMACIÓN PERSONAL -->
            <div class="tab-pane fade" id="personal" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-address-card text-success me-1"></i> Documento de Identidad</span>
                            <div class="info-value">{{ $aprendice->tipo_documento }} - {{ $aprendice->documento_identidad }}</div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-user text-success me-1"></i> Nombre Completo</span>
                            <div class="info-value">{{ $aprendice->nombres }} {{ $aprendice->apellidos }}</div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="far fa-envelope text-success me-1"></i> Correo Electrónico</span>
                            <div class="info-value">
                                @if($aprendice->correo_electronico)
                                    <a href="mailto:{{ $aprendice->correo_electronico }}" class="text-success text-decoration-none">
                                        {{ $aprendice->correo_electronico }}
                                    </a>
                                @else
                                    <span class="text-muted">No registrado</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-phone-alt text-success me-1"></i> Teléfono</span>
                            <div class="info-value">{{ $aprendice->telefono ?? 'No registrado' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 3: INFORMACIÓN EMPRESA -->
            <div class="tab-pane fade" id="empresa" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-industry text-success me-1"></i> Empresa Patrocinadora</span>
                            <div class="info-value">{{ $aprendice->empresa ?? 'No registrada' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-user-tie text-success me-1"></i> Jefe Inmediato</span>
                            <div class="info-value">{{ $aprendice->jefe_inmediato ?? 'No registrado' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="far fa-envelope text-success me-1"></i> Correo Empresa</span>
                            <div class="info-value">
                                @if($aprendice->correo_empresa)
                                    <a href="mailto:{{ $aprendice->correo_empresa }}" class="text-success text-decoration-none">
                                        {{ $aprendice->correo_empresa }}
                                    </a>
                                @else
                                    <span class="text-muted">No registrado</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-phone-alt text-success me-1"></i> Teléfono Empresa</span>
                            <div class="info-value">{{ $aprendice->telefono_empresa ?? 'No registrado' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 4: ETAPA PRODUCTIVA -->
            <div class="tab-pane fade" id="productiva" role="tabpanel">
                <div class="row g-3 mb-3">
                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="far fa-calendar-alt text-success me-1"></i> Fecha Inicio Práctica</span>
                            <div class="info-value">
                                {{ $aprendice->fecha_inicio_practica ? \Carbon\Carbon::parse($aprendice->fecha_inicio_practica)->format('d/m/Y') : 'Sin fecha registrada' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="far fa-calendar-check text-success me-1"></i> Fecha Fin Práctica</span>
                            <div class="info-value">
                                {{ $aprendice->fecha_fin_practica ? \Carbon\Carbon::parse($aprendice->fecha_fin_practica)->format('d/m/Y') : 'Sin fecha registrada' }}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="detail-box">
                            <span class="info-label d-block mb-2"><i class="fas fa-file-contract text-success me-1"></i> Detalles del Contrato / Observaciones</span>
                            <p class="mb-0 text-secondary" style="white-space: pre-line; line-height: 1.6;">{{ $aprendice->detalles_contrato ?? 'Sin observaciones o detalles de contrato registrados.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@stop