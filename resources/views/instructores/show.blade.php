@extends('adminlte::page')

@section('title', 'Detalle del Instructor')

@section('css')
<style>
.content-wrapper {
    background: linear-gradient(135deg, #f8fff9 0%, #f3fbf6 100%);
}

.card-outline.card-success {
    border-top: 4px solid #198754 !important;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(25, 135, 84, 0.08) !important;
}

.profile-card {
    background: linear-gradient(135deg, #ffffff 0%, #f4fbf6 100%);
    border-radius: 18px;
    border: 1px solid #e1efe6;
}

.avatar-circle {
    width: 110px;
    height: 110px;
    background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
    color: #198754;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.15);
}

.info-label {
    font-weight: 700;
    color: #2f3b46;
    font-size: 0.9rem;
}

.info-value {
    color: #495057;
    font-weight: 600;
    font-size: 0.95rem;
}

.badge-programa {
    background-color: #e8f5e9;
    color: #1b5e20;
    border: 1px solid #c8e6c9;
    font-weight: 600;
    font-size: 0.88rem;
    padding: 0.55rem 0.9rem;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    transition: all 0.2s ease;
}

.badge-programa:hover {
    background-color: #c8e6c9;
    transform: translateY(-2px);
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-id-badge me-2"></i>
                    Detalle del Instructor
                </h2>
                <p class="text-muted mb-0">
                    Consulte el perfil completo del instructor y sus asignaciones actuales.
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('instructores.edit', $instructor->id) }}" class="btn btn-success px-4 py-2" style="border-radius: 10px;">
                    <i class="fas fa-edit me-2"></i>
                    Editar
                </a>
                <a href="{{ route('instructores.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <!-- TARJETA RESUMEN DEL INSTRUCTOR -->
    <div class="col-lg-4 mb-4">
        <div class="card profile-card shadow-sm h-100 border-0 p-4 text-center">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <div class="avatar-circle mb-3">
                    <i class="fas fa-user-tie fa-3x"></i>
                </div>
                
                <h4 class="fw-bold text-dark mb-1">
                    {{ $instructor->nombres }}
                </h4>
                <h5 class="fw-bold text-muted mb-3">
                    {{ $instructor->apellidos }}
                </h5>

                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill font-weight-bold">
                    <i class="fas fa-chalkboard-teacher me-1"></i> Instructor SENA
                </span>
            </div>
        </div>
    </div>

    <!-- TARJETA INFORMACIÓN GENERAL -->
    <div class="col-lg-8 mb-4">
        <div class="card card-outline card-success shadow-lg border-0 h-100">
            <div class="card-header bg-white py-3 border-0">
                <h3 class="card-title font-weight-bold text-success mb-0">
                    <i class="fas fa-id-card me-2"></i>
                    Información de Identificación y Contacto
                </h3>
            </div>

            <div class="card-body p-4">
                <div class="row align-items-center mb-3">
                    <div class="col-sm-4 info-label">
                        <i class="fas fa-address-card text-success me-2"></i>
                        Tipo de Documento
                    </div>
                    <div class="col-sm-8 info-value">
                        @switch($instructor->tipo_documento)
                            @case('CC') Cédula de Ciudadanía @break
                            @case('TI') Tarjeta de Identidad @break
                            @case('CE') Cédula de Extranjería @break
                            @default {{ $instructor->tipo_documento }}
                        @endswitch
                    </div>
                </div>

                <hr class="my-3 text-muted opacity-25">

                <div class="row align-items-center mb-3">
                    <div class="col-sm-4 info-label">
                        <i class="fas fa-fingerprint text-success me-2"></i>
                        Número de Documento
                    </div>
                    <div class="col-sm-8 info-value">
                        {{ $instructor->documento_identidad }}
                    </div>
                </div>

                <hr class="my-3 text-muted opacity-25">

                <div class="row align-items-center mb-3">
                    <div class="col-sm-4 info-label">
                        <i class="fas fa-envelope text-success me-2"></i>
                        Correo Electrónico
                    </div>
                    <div class="col-sm-8 info-value">
                        <a href="mailto:{{ $instructor->correo_electronico }}" class="text-success text-decoration-none">
                            {{ $instructor->correo_electronico }}
                        </a>
                    </div>
                </div>

                <hr class="my-3 text-muted opacity-25">

                <div class="row align-items-center">
                    <div class="col-sm-4 info-label">
                        <i class="fas fa-phone-alt text-success me-2"></i>
                        Teléfono / Celular
                    </div>
                    <div class="col-sm-8 info-value">
                        {{ $instructor->telefono ?? 'No registrado' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECCIÓN DE PROGRAMAS DE FORMACIÓN -->
<div class="card card-outline card-success shadow-lg border-0 mb-4">
    <div class="card-header bg-white py-3 border-0">
        <h3 class="card-title font-weight-bold text-success mb-0">
            <i class="fas fa-graduation-cap me-2"></i>
            Programas de Formación Asignados
        </h3>
    </div>

    <div class="card-body p-4">
        @forelse($instructor->programas as $programa)
            <div class="badge-programa me-2 mb-2">
                <i class="fas fa-book-reader"></i>
                <span>{{ $programa->nombre_programa }}</span>
            </div>
        @empty
            <div class="alert alert-warning border-0 rounded-3 shadow-sm mb-0">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Este instructor no tiene programas de formación asignados en este momento.
            </div>
        @endforelse
    </div>
</div>

<!-- ACCIONES INFERIORES -->
<div class="d-flex justify-content-end gap-2 mb-5">
    <a href="{{ route('instructores.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 12px;">
        <i class="fas fa-arrow-left me-2"></i>
        Regresar al Listado
    </a>
</div>
@stop