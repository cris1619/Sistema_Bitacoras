@extends('adminlte::page')

@section('title', 'Nuevo Programa')

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

.card-header.bg-gradient-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%) !important;
    color: #fff;
    border: 0;
    padding: 1rem 1.25rem;
    font-weight: 700;
    letter-spacing: 0.3px;
}

.form-control,
.form-select {
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
.form-select:hover {
    border-color: #198754;
}

.form-control:focus,
.form-select:focus {
    border-color: #198754;
    box-shadow: 0 0 0 .2rem rgba(25,135,84,.15);
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

/* =========================================================
   HOMOLOGACIÓN VISUAL DE SELECT2 CON LOS INPUTS DEL FORMULARIO
   ========================================================= */

/* Contenedor general */
.select2-container--default .select2-selection--single {
    height: 46px !important;
    border: 1px solid #d8e4dd !important;
    border-radius: 12px !important;
    background-color: #ffffff !important;
    padding: 0 0.4rem !important;
    display: flex !important;
    align-items: center !important;
    transition: all .25s ease !important;
}

/* Hover */
.select2-container--default:hover .select2-selection--single {
    border-color: #198754 !important;
}

/* Focus / Desplegado */
.select2-container--default.select2-container--open .select2-selection--single,
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #198754 !important;
    box-shadow: 0 0 0 .2rem rgba(25, 135, 84, .15) !important;
    outline: none !important;
}

/* Texto del item seleccionado y placeholder */
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #2f3b46 !important;
    font-size: 15px !important;
    font-weight: 500 !important;
    line-height: normal !important;
    padding-left: 0.5rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #6c757d !important;
    font-weight: 500 !important;
}

/* Flecha desplegable */
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100% !important;
    top: 0 !important;
    right: 12px !important;
    display: flex !important;
    align-items: center !important;
}

/* Menú desplegable flotante (opciones) */
.select2-dropdown {
    border: 1px solid #d8e4dd !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
    overflow: hidden !important;
    z-index: 1055 !important;
}

/* Opciones individuales */
.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #198754 !important;
    color: #ffffff !important;
}

.select2-results__option {
    padding: 0.6rem 1rem !important;
    font-size: 15px !important;
    font-weight: 500 !important;
}

/* Estado de Error */
.is-invalid + .select2-container--default .select2-selection--single {
    border-color: #dc3545 !important;
}

.btn-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    transition: transform .2s ease, box-shadow .2s ease;
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.18);
}

.btn-success:hover {
    transform: translateY(-1px);
}

.btn-outline-secondary {
    border-radius: 12px;
    padding: 0.75rem 1.25rem;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-book me-2"></i> Registrar Programa
                </h2>
                <p class="text-muted mb-0">
                    Complete la información del programa de formación con datos claros y consistentes.
                </p>
            </div>
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill border border-success-subtle">
                <i class="fas fa-check-circle me-2"></i> Formulario activo
            </span>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="card card-outline card-success shadow-lg">
    <div class="card-body p-4">
        <form action="{{ route('programas.store') }}" method="POST">
            @csrf

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-success">
                    <i class="fas fa-graduation-cap mr-2"></i> Información del Programa
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Código -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-barcode text-success me-2"></i> Código Programa
                            </label>
                            <input 
                                type="text" 
                                name="codigo_programa" 
                                class="form-control @error('codigo_programa') is-invalid @enderror" 
                                value="{{ old('codigo_programa') }}"
                                placeholder="Ej: 228106"
                            >
                            @error('codigo_programa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nivel -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-layer-group text-success me-2"></i> Nivel Formación
                            </label>
                            <select 
                                id="nivel_formacion" 
                                name="nivel_formacion" 
                                class="form-select @error('nivel_formacion') is-invalid @enderror"
                            >
                                <option value="">Seleccione un nivel</option>
                                <option value="Técnico" {{ old('nivel_formacion') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                                <option value="Tecnólogo" {{ old('nivel_formacion') == 'Tecnólogo' ? 'selected' : '' }}>Tecnólogo</option>
                                <option value="Especialización" {{ old('nivel_formacion') == 'Especialización' ? 'selected' : '' }}>Especialización</option>
                            </select>
                            @error('nivel_formacion')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Nombre -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-book-open text-success me-2"></i> Nombre Programa
                            </label>
                            <input 
                                type="text" 
                                name="nombre_programa" 
                                class="form-control @error('nombre_programa') is-invalid @enderror" 
                                value="{{ old('nombre_programa') }}"
                                placeholder="Ej: Análisis y Desarrollo de Software"
                            >
                            @error('nombre_programa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button type="submit" class="btn btn-success btn-lg px-4">
                    <i class="fas fa-save me-2"></i> Guardar Programa
                </button>
                <a href="{{ route('programas.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="fas fa-times me-2"></i> Cancelar
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
$(document).ready(function() {
    $('#nivel_formacion').select2({
        placeholder: "Seleccione un nivel",
        allowClear: true,
        width: '100%'
    });
});
</script>
@stop