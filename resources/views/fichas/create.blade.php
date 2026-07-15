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
    box-shadow: 0 12px 35px rgba(25, 135, 84, 0.10) !important;
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

.btn-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.18);
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-id-card me-2"></i>
                    Nueva Ficha
                </h2>
                <p class="text-muted mb-0">
                    Registre una nueva ficha de formación asociada a un programa.
                </p>
            </div>
            <a href="{{ route('fichas.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Volver
            </a>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="card card-outline card-success shadow-lg">
    <div class="card-body p-4">
        <form action="{{ route('fichas.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Número de Ficha</label>
                    <input
                        type="text"
                        name="numero_ficha"
                        class="form-control @error('numero_ficha') is-invalid @enderror"
                        value="{{ old('numero_ficha') }}"
                        required
                    >

                    @error('numero_ficha')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Programa de Formación</label>
                    <select
                        name="programa_id"
                        class="form-select @error('programa_id') is-invalid @enderror"
                        required>
                        <option value="">Seleccione un programa</option>
                        @foreach($programas as $programa)
                            <option value="{{ $programa->id }}" {{ old('programa_id') == $programa->id ? 'selected' : '' }}>
                                {{ $programa->nombre_programa }}
                            </option>
                        @endforeach
                    </select>

                    @error('programa_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="{{ route('fichas.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="fas fa-times me-2"></i>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-success btn-lg px-4">
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
$(function () {
    $('select').not('[multiple]').select2({
        width: '100%'
    });
});
</script>
@stop