@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('css')
<style>
.content-wrapper {
    background: linear-gradient(135deg, #f8fff9 0%, #f3fbf6 100%);
}

.card-custom {
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
    border: none;
    transition: all 0.3s ease;
}

.card-custom .card-header {
    border-bottom: none;
    padding: 1.2rem 1.5rem;
    font-weight: 700;
}

.form-control, .form-select {
    min-height: 46px;
    border: 1px solid #d8e4dd;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 500;
    padding: 0.72rem 0.9rem;
    transition: all .25s ease;
}

.form-control:hover, .form-select:hover {
    border-color: #198754;
}

.form-control:focus, .form-select:focus {
    border-color: #198754;
    box-shadow: 0 0 0 .2rem rgba(25, 135, 84, .15);
}

label {
    font-weight: 700;
    color: #2f3b46;
    margin-bottom: 0.55rem;
    font-size: 0.9rem;
}

/* Custom Radio Badges para Selección de Roles */
.role-radio-card {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.25s ease;
    background: #ffffff;
    margin-bottom: 0.75rem;
}

.role-radio-card:hover {
    border-color: #198754;
    background: rgba(25, 135, 84, 0.02);
}

.role-radio-input {
    display: none;
}

.role-radio-input:checked + .role-radio-card {
    border-color: #198754;
    background: rgba(25, 135, 84, 0.08);
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.12);
}

.btn-success-gradient {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.18);
    border-radius: 12px;
}

.btn-success-gradient:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 22px rgba(25, 135, 84, 0.25);
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-user-edit me-2"></i>
                    Editar Usuario
                </h2>
                <p class="text-muted mb-0">
                    Actualice los datos de la cuenta, seguridad, rol asignado y detalles de perfil.
                </p>
            </div>
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
                <i class="fas fa-arrow-left me-2"></i>
                Volver
            </a>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

@if ($errors->any())
<div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
    <h5 class="mb-2"><i class="fas fa-ban me-2"></i>Se encontraron errores en el formulario</h5>
    <ul class="mb-0 ps-3">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('usuarios.update', $usuario) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- COLUMNA IZQUIERDA: INFORMACIÓN GENERAL Y SEGURIDAD -->
        <div class="col-lg-6 mb-4">
            
            <!-- INFORMACIÓN GENERAL -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-white text-success border-bottom">
                    <i class="fas fa-id-card me-2"></i>Información General
                </div>
                <div class="card-body p-4">
                    <div class="form-group mb-3">
                        <label>Nombre Completo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="far fa-user text-muted"></i></span>
                            <input type="text" name="nombre_completo" value="{{ old('nombre_completo', $usuario->nombre_completo) }}" class="form-control border-start-0 @error('nombre_completo') is-invalid @enderror" placeholder="Nombre completo">
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label>Correo Electrónico <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="far fa-envelope text-muted"></i></span>
                            <input type="email" name="email" value="{{ old('email', $usuario->email) }}" class="form-control border-start-0 @error('email') is-invalid @enderror" placeholder="correo@sena.edu.co">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEGURIDAD -->
            <div class="card card-custom">
                <div class="card-header bg-white text-warning border-bottom">
                    <i class="fas fa-lock me-2"></i>Seguridad
                </div>
                <div class="card-body p-4">
                    <div class="form-group mb-3">
                        <label>Nueva contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fas fa-key text-muted"></i></span>
                            <input type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="••••••••">
                        </div>
                        <small class="text-muted mt-1 d-block">Déjelo vacío si no desea cambiar la clave.</small>
                    </div>

                    <div class="form-group mb-0">
                        <label>Confirmar contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fas fa-check-double text-muted"></i></span>
                            <input type="password" name="password_confirmation" class="form-control border-start-0" placeholder="••••••••">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- COLUMNA DERECHA: ROL Y INFORMACIÓN DEL PERFIL -->
        <div class="col-lg-6 mb-4">

            <!-- ROL DEL USUARIO -->
            <div class="card card-custom mb-4">
                <div class="card-header bg-white text-primary border-bottom">
                    <i class="fas fa-user-shield me-2"></i>Rol del Usuario
                </div>
                <div class="card-body p-4">
                    @php
                        $rolActual = $usuario->roles->first()?->id;
                    @endphp

                    <div class="row">
                        @foreach($roles as $rol)
                            @php
                                switch($rol->nombre_rol){
                                    case 'Administrador':
                                        $color = 'danger';
                                        $icon  = 'fas fa-user-shield';
                                        break;
                                    case 'Coordinador':
                                        $color = 'primary';
                                        $icon  = 'fas fa-user-tie';
                                        break;
                                    case 'Instructor':
                                        $color = 'success';
                                        $icon  = 'fas fa-chalkboard-teacher';
                                        break;
                                    case 'Aprendiz':
                                        $color = 'info';
                                        $icon  = 'fas fa-user-graduate';
                                        break;
                                    default:
                                        $color = 'secondary';
                                        $icon  = 'fas fa-user';
                                }
                            @endphp

                            <div class="col-sm-6">
                                <label class="w-100 mb-0">
                                    <input type="radio" name="rol" value="{{ $rol->id }}" class="role-radio-input" {{ old('rol', $rolActual) == $rol->id ? 'checked' : '' }}>
                                    <div class="role-radio-card">
                                        <span class="badge badge-{{ $color }} me-2 p-2">
                                            <i class="{{ $icon }}"></i>
                                        </span>
                                        <span class="fw-bold text-dark">{{ $rol->nombre_rol }}</span>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- INFORMACIÓN DEL PERFIL -->
            <div class="card card-custom">
                <div class="card-header bg-white text-info border-bottom">
                    <i class="fas fa-address-card me-2"></i>Información del Perfil Asociado
                </div>
                <div class="card-body p-4">
                    @if($usuario->instructor)
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success-subtle text-success border border-success px-3 py-2 rounded-pill me-2">
                                <i class="fas fa-chalkboard-teacher me-1"></i> Perfil Instructor
                            </span>
                        </div>

                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item bg-transparent px-0 border-bottom-0">
                                <strong><i class="far fa-id-badge text-muted me-2"></i>Documento:</strong> 
                                <span class="text-secondary">{{ $usuario->instructor->documento_identidad }}</span>
                            </li>
                            <li class="list-group-item bg-transparent px-0 border-bottom-0">
                                <strong><i class="far fa-user text-muted me-2"></i>Nombre:</strong> 
                                <span class="text-secondary">{{ $usuario->instructor->nombre_completo }}</span>
                            </li>
                        </ul>

                        <label class="d-block font-weight-bold mb-2">Programas Asignados:</label>
                        <div class="p-3 bg-light rounded-3" style="border: 1px solid #e9ecef; max-height: 180px; overflow-y: auto;">
                            @foreach($programas as $programa)
                                <div class="form-check mb-2">
                                    <input type="checkbox" name="programas[]" value="{{ $programa->id }}" id="programa{{ $programa->id }}" class="form-check-input" {{ $usuario->instructor->programas->contains($programa->id) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-normal" for="programa{{ $programa->id }}">
                                        {{ $programa->nombre_programa }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    @elseif($usuario->aprendiz)
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-info-subtle text-info border border-info px-3 py-2 rounded-pill me-2">
                                <i class="fas fa-user-graduate me-1"></i> Perfil Aprendiz
                            </span>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3">
                                    <small class="text-muted d-block mb-1">Documento</small>
                                    <span class="fw-bold">{{ $usuario->aprendiz->documento_identidad }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-3">
                                    <small class="text-muted d-block mb-1">Ficha</small>
                                    <span class="fw-bold">{{ optional($usuario->aprendiz->ficha)->numero_ficha ?? 'Sin Ficha' }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 bg-light rounded-3">
                                    <small class="text-muted d-block mb-1">Programa</small>
                                    <span class="fw-bold">{{ optional(optional($usuario->aprendiz->ficha)->programa)->nombre_programa ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Estado Actual</small>
                                    <span class="badge bg-success px-3 py-1">
                                        {{ optional($usuario->aprendiz->estado)->nombre_estado ?? 'Desconocido' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="alert alert-warning border-0 rounded-3 mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Este usuario no cuenta con un perfil de Instructor o Aprendiz vinculado actualmente.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- ACCIONES DEL FORMULARIO -->
    <div class="d-flex align-items-center justify-content-end gap-2 mb-5 mt-2">
        <a href="{{ route('usuarios.index') }}" class="btn btn-light px-4 py-2 font-weight-bold text-secondary me-2" style="border-radius: 12px;">
            Cancelar
        </a>
        <button type="submit" class="btn btn-success-gradient px-5 py-2 font-weight-bold text-white">
            <i class="fas fa-save me-2"></i>
            Guardar Cambios
        </button>
    </div>
</form>
@stop