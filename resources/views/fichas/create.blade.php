@extends('adminlte::page')

@section('title', 'Nueva Ficha')

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
    box-shadow: 0 12px 35px rgba(25, 135, 84, 0.08) !important;
}

.form-label {
    font-weight: 600;
    color: #2f3b46;
    margin-bottom: 0.5rem;
}

/* Base idéntica para Inputs y Selects */
.form-control,
.form-select {
    min-height: 48px;
    border: 1px solid #d8e4dd;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 500;
    padding: 0.75rem 1rem;
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
    box-shadow: 0 0 0 .25rem rgba(25, 135, 84, 0.15);
}

/* =========================================================
   HOMOLOGACIÓN EXACTA DE SELECT2 AL DISEÑO DEL INPUT
   ========================================================= */
.select2-container {
    width: 100% !important;
    display: block;
}

.select2-container--default .select2-selection--single {
    min-height: 48px !important;
    height: 48px !important;
    border: 1px solid #d8e4dd !important;
    border-radius: 12px !important;
    background-color: #fff !important;
    padding: 0.5rem 0.75rem !important;
    display: flex !important;
    align-items: center !important;
    transition: all .25s ease !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #495057 !important;
    font-size: 0.95rem !important;
    font-weight: 500 !important;
    line-height: normal !important;
    padding-left: 0 !important;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #6c757d !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100% !important;
    top: 0 !important;
    right: 12px !important;
    display: flex !important;
    align-items: center !important;
}

/* Estado Hover y Focus de Select2 */
.select2-container--default:hover .select2-selection--single {
    border-color: #198754 !important;
}

.select2-container--default.select2-container--open .select2-selection--single,
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #198754 !important;
    box-shadow: 0 0 0 .25rem rgba(25, 135, 84, 0.15) !important;
    outline: none !important;
}

/* Estado de Error de Validación */
.is-invalid + .select2-container--default .select2-selection--single {
    border-color: #dc3545 !important;
}

/* Estilo del menú desplegable emergente */
.select2-dropdown {
    border: 1px solid #d8e4dd !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
    overflow: hidden !important;
    z-index: 9999 !important;
}

.select2-results__option--highlighted[aria-selected] {
    background-color: #198754 !important;
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

.btn-outline-secondary {
    border-radius: 10px;
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
                    <i class="fas fa-plus-circle me-2"></i>
                    Nueva Ficha
                </h2>
                <p class="text-muted mb-0">
                    Registre una nueva ficha de formación asociada a un programa existente.
                </p>
            </div>
            <div>
                <a href="{{ route('fichas.index') }}" class="btn btn-outline-secondary px-3 py-2">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver al listado
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

<div class="card card-outline card-success shadow-lg border-0">
    <div class="card-body p-4">
        <form action="{{ route('fichas.store') }}" method="POST">
            @csrf

            <div class="row">
                <!-- Número de Ficha -->
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        <i class="fas fa-hashtag text-success me-1"></i>
                        Número de Ficha <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        name="numero_ficha"
                        class="form-control @error('numero_ficha') is-invalid @enderror"
                        placeholder="Ej: 2558930"
                        value="{{ old('numero_ficha') }}"
                        required
                    >

                    @error('numero_ficha')
                        <div class="invalid-feedback d-block mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Programa de Formación -->
                <div class="col-md-6 mb-4">
                    <label class="form-label">
                        <i class="fas fa-graduation-cap text-success me-1"></i>
                        Programa de Formación <span class="text-danger">*</span>
                    </label>
                    <select
                        name="programa_id"
                        id="programa_id"
                        class="form-control select2-custom @error('programa_id') is-invalid @enderror"
                        required>
                        <option value=""></option>
                        @foreach($programas as $programa)
                            <option value="{{ $programa->id }}" {{ old('programa_id') == $programa->id ? 'selected' : '' }}>
                                {{ $programa->nombre_programa }}
                            </option>
                        @endforeach
                    </select>

                    @error('programa_id')
                        <div class="invalid-feedback d-block mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <hr class="my-4" style="border-color: #e9ecef;">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('fichas.index') }}" class="btn btn-outline-secondary px-4 py-2 me-2">
                    <i class="fas fa-times me-2"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-success px-4 py-2 font-weight-bold">
                    <i class="fas fa-save me-2"></i>
                    Guardar Ficha
                </button>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    $('.select2-custom').select2({
        placeholder: 'Seleccione un programa...',
        allowClear: true,
        width: '100%'
    });
});
</script>
@stop