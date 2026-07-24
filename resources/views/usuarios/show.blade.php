@extends('adminlte::page')

@section('title', 'Detalle del Usuario')

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
                    <i class="fas fa-user-cog me-2"></i>
                    {{ $usuario->nombre_completo }}
                </h2>
                <p class="text-muted mb-0">
                    <i class="far fa-envelope me-1"></i> <strong>{{ $usuario->email }}</strong>
                </p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning px-4 py-2 text-white font-weight-bold" style="border-radius: 10px;">
                    <i class="fas fa-edit me-2"></i>
                    Editar
                </a>

                <!-- Botón Disparador del Modal -->
                <button type="button" class="btn btn-outline-warning px-4 py-2 font-weight-bold" style="border-radius: 10px;" data-toggle="modal" data-target="#modalResetPassword{{ $usuario->id }}">
                    <i class="fas fa-key me-2"></i>
                    Restablecer Clave
                </button>

                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Restablecer Contraseña -->
@include('partials.modal-reset-password', [
    'modalId' => 'modalResetPassword' . $usuario->id,
    'route'   => route('usuarios.reset-password', $usuario),
    'message' => '¿Desea restablecer la contraseña de este usuario? La nueva contraseña será su número de documento.'
])
@stop

@section('content')

@include('partials.alerts')

<div class="card card-outline card-success shadow-lg border-0 mb-5">
    
    <!-- Pestañas de Navegación -->
    <ul class="nav nav-tabs nav-tabs-custom" id="usuarioShowTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="cuenta-tab" data-toggle="tab" data-target="#cuenta" type="button" role="tab">
                <i class="fas fa-user-shield me-2"></i>Información de Cuenta
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="perfil-tab" data-toggle="tab" data-target="#perfil" type="button" role="tab">
                <i class="fas fa-address-card me-2"></i>Perfil Asociado
            </button>
        </li>
    </ul>

    <div class="card-body p-4">
        <div class="tab-content" id="usuarioShowTabContent">
            
            <!-- TAB 1: INFORMACIÓN DE CUENTA -->
            <div class="tab-pane fade show active" id="cuenta" role="tabpanel">
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-user text-success me-1"></i> Nombre Completo</span>
                            <div class="info-value">{{ $usuario->nombre_completo }}</div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="far fa-envelope text-success me-1"></i> Correo Electrónico</span>
                            <div class="info-value">
                                <a href="mailto:{{ $usuario->email }}" class="text-success text-decoration-none">
                                    {{ $usuario->email }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="fas fa-user-tag text-success me-1"></i> Rol Asignado</span>
                            <div class="d-flex flex-wrap gap-1 mt-1">
                                @forelse($usuario->roles as $rol)
                                    @php
                                        switch($rol->nombre_rol){
                                            case 'Administrador': $badgeClass = 'badge-danger'; break;
                                            case 'Coordinador': $badgeClass = 'badge-primary'; break;
                                            case 'Instructor': $badgeClass = 'badge-success'; break;
                                            case 'Aprendiz': $badgeClass = 'badge-info'; break;
                                            default: $badgeClass = 'badge-secondary';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }} badge-custom">
                                        {{ $rol->nombre_rol }}
                                    </span>
                                @empty
                                    <span class="badge badge-secondary badge-custom">Sin Rol</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="detail-box">
                            <span class="info-label d-block"><i class="far fa-clock text-success me-1"></i> Fecha de Registro</span>
                            <div class="info-value">
                                {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y - h:i A') : 'No registrada' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: PERFIL ASOCIADO -->
            <div class="tab-pane fade" id="perfil" role="tabpanel">
                @if($usuario->instructor)
                    <div class="d-flex align-items-center mb-4">
                        <span class="badge bg-success text-white px-3 py-2 rounded-pill fs-6">
                            <i class="fas fa-chalkboard-teacher me-2"></i>Perfil de Instructor
                        </span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="info-label d-block"><i class="far fa-id-badge text-success me-1"></i> Documento de Identidad</span>
                                <div class="info-value">{{ $usuario->instructor->documento_identidad }}</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="info-label d-block"><i class="fas fa-user-check text-success me-1"></i> Nombre Completo</span>
                                <div class="info-value">{{ $usuario->instructor->nombre_completo }}</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="info-label d-block"><i class="far fa-envelope text-success me-1"></i> Correo de Contacto</span>
                                <div class="info-value">{{ $usuario->instructor->correo_electronico ?? 'No registrado' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="info-label d-block"><i class="fas fa-phone-alt text-success me-1"></i> Teléfono</span>
                                <div class="info-value">{{ $usuario->instructor->telefono ?? 'No registrado' }}</div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="detail-box">
                                <span class="info-label d-block mb-2"><i class="fas fa-book text-success me-1"></i> Programas de Formación Asignados</span>
                                <div class="d-flex flex-wrap gap-2">
                                    @forelse($usuario->instructor->programas as $programa)
                                        <span class="badge badge-success badge-custom">
                                            <i class="fas fa-graduation-cap me-1"></i> {{ $programa->nombre_programa }}
                                        </span>
                                    @empty
                                        <span class="text-muted">No tiene programas asignados.</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($usuario->aprendiz)
                    <div class="d-flex align-items-center mb-4">
                        <span class="badge bg-info text-white px-3 py-2 rounded-pill fs-6">
                            <i class="fas fa-user-graduate me-2"></i>Perfil de Aprendiz
                        </span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="info-label d-block"><i class="far fa-id-card text-success me-1"></i> Documento de Identidad</span>
                                <div class="info-value">{{ $usuario->aprendiz->documento_identidad }}</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="info-label d-block"><i class="fas fa-layer-group text-success me-1"></i> Ficha</span>
                                <span class="badge badge-info badge-custom">
                                    {{ optional($usuario->aprendiz->ficha)->numero_ficha ?? 'Sin Ficha' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="info-label d-block"><i class="fas fa-book text-success me-1"></i> Programa de Formación</span>
                                <div class="info-value">
                                    {{ optional(optional($usuario->aprendiz->ficha)->programa)->nombre_programa ?? 'Sin programa' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-box">
                                <span class="info-label d-block"><i class="fas fa-info-circle text-success me-1"></i> Estado del Aprendiz</span>
                                <span class="badge badge-success badge-custom">
                                    {{ optional($usuario->aprendiz->estado)->nombre_estado ?? 'No definido' }}
                                </span>
                            </div>
                        </div>
                    </div>

                @else
                    <div class="alert alert-warning border-0 shadow-sm rounded-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Este usuario no cuenta con un perfil adicional (Instructor o Aprendiz) vinculado en el sistema.
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@stop