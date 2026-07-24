@extends('adminlte::page')

@section('title', 'Usuarios')

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

.table-custom {
    vertical-align: middle;
}

.table-custom thead {
    background-color: #f1f8f4;
    color: #2f3b46;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.82rem;
    letter-spacing: 0.5px;
}

.table-custom th, .table-custom td {
    padding: 1rem 1.25rem;
    border-color: #edf3ee;
}

.avatar-initial {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
}

.btn-action {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.btn-action:hover {
    transform: translateY(-2px);
}

.btn-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    transition: transform .2s ease, box-shadow .2s ease;
    box-shadow: 0 6px 18px rgba(25, 135, 84, 0.2);
    border-radius: 10px;
}

.btn-success:hover {
    transform: translateY(-1px);
}

.badge-status {
    padding: 0.45em 0.8em;
    font-size: 0.8rem;
    font-weight: 600;
    border-radius: 8px;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-users-cog me-2"></i>
                    Administración de Usuarios
                </h2>
                <p class="text-muted mb-0">
                    Gestión general de cuentas, roles de acceso y estados de usuarios en el sistema.
                </p>
            </div>
            <div>
                <a href="{{ route('usuarios.create') }}" class="btn btn-success px-4 py-2 font-weight-bold">
                    <i class="fas fa-user-plus me-2"></i>
                    Nuevo Usuario
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

<div class="card card-outline card-success shadow-lg border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-custom mb-0">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Correo Electrónico</th>
                        <th>Rol</th>
                        <th>Perfil</th>
                        <th class="text-center">Estado</th>
                        <th class="text-end" style="min-width: 180px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-initial me-3">
                                    {{ strtoupper(substr($usuario->nombre_completo ?? $usuario->name ?? 'U', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $usuario->nombre_completo }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="text-secondary font-weight-500">
                            <i class="far fa-envelope me-1 text-muted"></i>
                            {{ $usuario->email }}
                        </td>

                        <td>
                            @forelse($usuario->roles as $rol)
                                <span class="badge bg-light text-dark border px-2 py-1">
                                    <i class="fas fa-user-tag text-success me-1"></i>
                                    {{ $rol->nombre_rol }}
                                </span>
                            @empty
                                <span class="badge bg-light text-muted border px-2 py-1">Sin rol</span>
                            @endforelse
                        </td>

                        <td>
                            @if($usuario->aprendiz)
                                <span class="badge badge-status bg-info text-white">
                                    <i class="fas fa-user-graduate me-1"></i> Aprendiz
                                </span>
                            @elseif($usuario->instructor)
                                <span class="badge badge-status bg-primary text-white">
                                    <i class="fas fa-chalkboard-teacher me-1"></i> Instructor
                                </span>
                            @else
                                <span class="badge badge-status bg-dark text-white">
                                    <i class="fas fa-user-shield me-1"></i> Administrador
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if($usuario->deleted_at)
                                <span class="badge badge-status bg-danger text-white">
                                    Inactivo
                                </span>
                            @else
                                <span class="badge badge-status bg-success text-white">
                                    Activo
                                </span>
                            @endif
                        </td>

                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                {{-- Ver detalles --}}
                                <a href="{{ route('usuarios.show', $usuario) }}" 
                                   class="btn btn-action btn-outline-info" 
                                   title="Ver detalles"
                                   data-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Editar --}}
                                <a href="{{ route('usuarios.edit', $usuario) }}" 
                                   class="btn btn-action btn-outline-warning" 
                                   title="Editar usuario"
                                   data-toggle="tooltip">
                                    <i class="fas fa-pen"></i>
                                </a>

                                {{-- Estado (Activar/Desactivar) --}}
                                @if($usuario->deleted_at)
                                    <button type="button" 
                                            class="btn btn-action btn-outline-success" 
                                            data-toggle="modal" 
                                            data-target="#modalActivar{{ $usuario->id }}"
                                            title="Activar usuario">
                                        <i class="fas fa-user-check"></i>
                                    </button>

                                    @include('partials.modal-status-user', [
                                        'modalId' => 'modalActivar'.$usuario->id,
                                        'route'   => route('usuarios.activar', $usuario->id),
                                        'title'   => 'Activar usuario',
                                        'message' => '¿Desea volver a activar este usuario? Recuperará inmediatamente el acceso al sistema.',
                                        'button'  => 'Activar',
                                        'color'   => 'success',
                                        'icon'    => 'fas fa-user-check'
                                    ])
                                @else
                                    <button type="button" 
                                            class="btn btn-action btn-outline-danger" 
                                            data-toggle="modal" 
                                            data-target="#modalDesactivar{{ $usuario->id }}"
                                            title="Desactivar usuario">
                                        <i class="fas fa-user-slash"></i>
                                    </button>

                                    @include('partials.modal-status-user', [
                                        'modalId' => 'modalDesactivar'.$usuario->id,
                                        'route'   => route('usuarios.desactivar', $usuario),
                                        'title'   => 'Desactivar usuario',
                                        'message' => '¿Está seguro de desactivar este usuario? No podrá iniciar sesión hasta que vuelva a ser activado.',
                                        'button'  => 'Desactivar',
                                        'color'   => 'danger',
                                        'icon'    => 'fas fa-user-slash'
                                    ])
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted mb-2">
                                <i class="fas fa-users-slash fa-3x text-light mb-3"></i>
                                <h5>No hay usuarios registrados</h5>
                                <p class="small">Comienza creando un nuevo registro con el botón superior.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($usuarios->hasPages())
            <div class="p-3 border-top d-flex justify-content-end">
                {{ $usuarios->links() }}
            </div>
        @endif
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