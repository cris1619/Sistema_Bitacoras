@extends('adminlte::page')

@section('title', 'Registrar Instructor')

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

label {
    font-weight: 700;
    color: #2f3b46;
    margin-bottom: 0.55rem;
}

.btn-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.18);
}

.btn-success:hover {
    transform: translateY(-1px);
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
                    <i class="fas fa-user-plus me-2"></i>
                    Registrar Instructor
                </h2>
                <p class="text-muted mb-0">
                    Complete la información personal y los programas de formación asignados al instructor.
                </p>
            </div>
            <a href="{{ route('instructores.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Volver
            </a>
        </div>
    </div>
</div>
@stop

@section('content')
@if ($errors->any())
<div class="alert alert-danger rounded-3 border-0 shadow-sm">
    <h5 class="mb-2"><i class="fas fa-ban me-2"></i>Se encontraron los siguientes errores</h5>
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('instructores.store') }}" method="POST">
    @csrf

    <div class="card card-outline card-success shadow-lg mb-4">
        <div class="card-header bg-success text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-id-card me-2"></i>
                Información Personal
            </h3>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>Tipo de documento</label>
                    <select name="tipo_documento" class="form-control @error('tipo_documento') is-invalid @enderror" required>
                        <option value="">Seleccione</option>
                        <option value="CC" {{ old('tipo_documento')=='CC'?'selected':'' }}>Cédula</option>
                        <option value="TI" {{ old('tipo_documento')=='TI'?'selected':'' }}>Tarjeta de Identidad</option>
                        <option value="CE" {{ old('tipo_documento')=='CE'?'selected':'' }}>Cédula de Extranjería</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Documento</label>
                    <input type="text" name="documento_identidad" class="form-control @error('documento_identidad') is-invalid @enderror" value="{{ old('documento_identidad') }}" maxlength="20" placeholder="Número de documento">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Nombres</label>
                    <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres') }}" maxlength="100" placeholder="Ingrese los nombres">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos') }}" maxlength="100" placeholder="Ingrese los apellidos">
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-success shadow-lg mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-address-book me-2"></i>
                Información de Contacto
            </h3>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Correo electrónico</label>
                    <input type="email" name="correo_electronico" class="form-control @error('correo_electronico') is-invalid @enderror" value="{{ old('correo_electronico') }}" placeholder="correo@sena.edu.co">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" maxlength="20" placeholder="Número de teléfono">
                </div>
            </div>
        </div>
    </div>

    <div class="card card-outline card-success shadow-lg mb-4">
        <div class="card-header bg-success text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-graduation-cap me-2"></i>
                Programas de Formación
            </h3>
        </div>
        <div class="card-body p-4">
            <div class="form-group">
                <label>Seleccione uno o varios programas</label>
                <select name="programas[]" class="form-control @error('programas') is-invalid @enderror" multiple size="8" required>
                    @foreach($programas as $programa)
                        <option value="{{ $programa->id }}" @selected(collect(old('programas'))->contains($programa->id))>
                            {{ $programa->nombre_programa }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Mantenga presionada la tecla <strong>Ctrl</strong> para seleccionar varios programas.</small>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2 mt-4">
        <a href="{{ route('instructores.index') }}" class="btn btn-outline-secondary btn-lg px-4">
            <i class="fas fa-times me-2"></i>
            Cancelar
        </a>
        <button type="submit" class="btn btn-success btn-lg px-4">
            <i class="fas fa-save me-2"></i>
            Registrar Instructor
        </button>
    </div>
</form>
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