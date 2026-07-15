@extends('adminlte::page')

@section('title', 'Nuevo Aprendiz')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
.content-wrapper {
    background: linear-gradient(135deg, #f8fff9 0%, #f3fbf6 100%);
}

.card-outline.card-success {
    border-top: 4px solid #198754 !important;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(25, 135, 84, 0.10) !important;
}

.card-header {
    border: 0;
    font-weight: 700;
    letter-spacing: 0.3px;
}

.card-header.bg-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%) !important;
}

.card-header.bg-primary {
    background: linear-gradient(135deg, #2f8efc 0%, #0d6efd 100%) !important;
}

.form-control,
.form-select,
textarea {
    min-height: 46px;
    border: 1px solid #d8e4dd;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 500;
    padding: 0.72rem 0.9rem;
    transition: all .25s ease;
    box-shadow: none;
}

.form-control:hover,
.form-select:hover,
textarea:hover {
    border-color: #198754;
}

.form-control:focus,
.form-select:focus,
textarea:focus {
    border-color: #198754;
    box-shadow: 0 0 0 .2rem rgba(25, 135, 84, .15);
}

.form-label {
    font-weight: 700;
    color: #2f3b46;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.55rem;
}

.form-label i {
    width: 18px;
}

.btn-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.18);
}

.btn-success:hover {
    transform: translateY(-1px);
}

.btn-outline-secondary {
    border-radius: 12px;
    padding: 0.75rem 1.25rem;
}

.select2-container--default .select2-selection--single {
    min-height: 46px;
    height: 46px;
    border: 1px solid #d8e4dd;
    border-radius: 12px;
    display: flex;
    align-items: center;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 42px !important;
    color: #495057;
}
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #198754;
    box-shadow: 0 0 0 .2rem rgba(25,135,84,.15);
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
                    Registrar Aprendiz
                </h2>
                <p class="text-muted mb-0">
                    Complete la información académica, personal, empresarial y de etapa productiva del aprendiz.
                </p>
            </div>
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill border border-success-subtle">
                <i class="fas fa-check-circle me-2"></i>
                Formulario activo
            </span>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="card card-outline card-success shadow-lg">
    <div class="card-body p-4">
        <form action="{{ route('aprendices.store') }}" method="POST">
            @csrf

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Información Académica
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-id-card text-success me-2"></i>
                                Ficha
                            </label>
                            <select name="ficha_id" class="form-select @error('ficha_id') is-invalid @enderror">
                                <option value="">Seleccione</option>
                                @foreach($fichas as $ficha)
                                    <option value="{{ $ficha->id }}">
                                        {{ $ficha->numero_ficha }} - {{ $ficha->programa->nombre_programa }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ficha_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-toggle-on text-success me-2"></i>
                                Estado
                            </label>
                            <select name="estado_id" class="form-select">
                                @foreach($estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->nombre_estado }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user-graduate text-success me-2"></i>
                                Vínculo Formativo
                            </label>
                            <select name="vinculo_id" class="form-select">
                                @foreach($vinculos as $vinculo)
                                    <option value="{{ $vinculo->id }}">{{ $vinculo->nombre_vinculo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-user me-2"></i>
                    Información Personal
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">
                                <i class="fas fa-address-card text-primary me-2"></i>
                                Tipo Documento
                            </label>
                            <select name="tipo_documento" class="form-select">
                                <option value="CC">CC</option>
                                <option value="TI">TI</option>
                                <option value="CE">CE</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">
                                <i class="fas fa-id-card text-primary me-2"></i>
                                Documento
                            </label>
                            <input type="text" name="documento_identidad" class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user text-primary me-2"></i>
                                Nombres
                            </label>
                            <input type="text" name="nombres" class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user text-primary me-2"></i>
                                Apellidos
                            </label>
                            <input type="text" name="apellidos" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                Correo Electrónico
                            </label>
                            <input type="email" name="correo_electronico" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-phone text-primary me-2"></i>
                                Teléfono
                            </label>
                            <input type="text" name="telefono" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-building me-2"></i>
                    Información Empresa
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-building text-success me-2"></i>
                                Empresa
                            </label>
                            <input type="text" name="empresa" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user-tie text-success me-2"></i>
                                Jefe Inmediato
                            </label>
                            <input type="text" name="jefe_inmediato" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-envelope text-success me-2"></i>
                                Correo Empresa
                            </label>
                            <input type="email" name="correo_empresa" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-phone text-success me-2"></i>
                                Teléfono Empresa
                            </label>
                            <input type="text" name="telefono_empresa" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-briefcase me-2"></i>
                    Etapa Productiva
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-calendar-alt text-success me-2"></i>
                                Fecha Inicio
                            </label>
                            <input type="date" name="fecha_inicio_practica" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-calendar-alt text-success me-2"></i>
                                Fecha Fin
                            </label>
                            <input type="date" name="fecha_fin_practica" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-file-alt text-success me-2"></i>
                            Detalles Contrato
                        </label>
                        <textarea name="detalles_contrato" rows="4" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-success btn-lg px-4">
                    <i class="fas fa-save me-2"></i>
                    Guardar Aprendiz
                </button>
                <a href="{{ route('aprendices.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="fas fa-times me-2"></i>
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(function () {
    $('select').not('[multiple]').select2({
        width: '100%'
    });
});
</script>
@stop