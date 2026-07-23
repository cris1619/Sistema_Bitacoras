@extends('adminlte::page')

@section('title', 'Editar Programa')

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

.form-control, .form-select {
    border-radius: 10px;
    border: 1px solid #ced4da;
    padding: 0.6rem 0.9rem;
    transition: all 0.2s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
}

.btn-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    transition: transform .2s ease, box-shadow .2s ease;
    box-shadow: 0 6px 15px rgba(25, 135, 84, 0.18);
    border-radius: 10px;
}

.btn-success:hover {
    transform: translateY(-1px);
}

.btn-light-secondary {
    background-color: #f1f5f3;
    color: #495057;
    border: 1px solid #dde5e0;
    border-radius: 10px;
    transition: all 0.2s ease;
}

.btn-light-secondary:hover {
    background-color: #e2ebe5;
    color: #212529;
}

.input-group-text {
    border-radius: 10px 0 0 10px;
    background-color: #f8fff9;
    border-color: #ced4da;
    color: #198754;
}

.input-group .form-control, 
.input-group .form-select {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-1 fw-bold">
                    <i class="fas fa-edit me-2"></i>
                    Editar Programa
                </h2>
                <p class="text-muted mb-0">
                    Actualiza la información del programa académico <span class="fw-bold text-dark">#{{ $programa->codigo_programa }}</span>.
                </p>
            </div>
            <div>
                <a href="{{ route('programas.index') }}" class="btn btn-light-secondary px-3 py-2 font-weight-bold">
                    <i class="fas fa-arrow-left me-1"></i>
                    Volver a la lista
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card card-outline card-success shadow-lg border-0 mb-5">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('programas.update', $programa) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Código -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold text-secondary mb-2">
                                Código del Programa <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-barcode"></i>
                                </span>
                                <input type="text"
                                       name="codigo_programa"
                                       class="form-control @error('codigo_programa') is-invalid @enderror"
                                       value="{{ old('codigo_programa', $programa->codigo_programa) }}"
                                       placeholder="Ej: 228106">
                                @error('codigo_programa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Nivel -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold text-secondary mb-2">
                                Nivel de Formación <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-layer-group"></i>
                                </span>
                                <select name="nivel_formacion"
                                        class="form-select @error('nivel_formacion') is-invalid @enderror">
                                    <option value="">Seleccione un nivel...</option>
                                    <option value="Técnico" {{ old('nivel_formacion', $programa->nivel_formacion) == 'Técnico' ? 'selected' : '' }}>
                                        Técnico
                                    </option>
                                    <option value="Tecnólogo" {{ old('nivel_formacion', $programa->nivel_formacion) == 'Tecnólogo' ? 'selected' : '' }}>
                                        Tecnólogo
                                    </option>
                                    <option value="Especialización" {{ old('nivel_formacion', $programa->nivel_formacion) == 'Especialización' ? 'selected' : '' }}>
                                        Especialización
                                    </option>
                                </select>
                                @error('nivel_formacion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Nombre -->
                        <div class="col-12 mb-4">
                            <label class="form-label font-weight-bold text-secondary mb-2">
                                Nombre del Programa <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-graduation-cap"></i>
                                </span>
                                <input type="text"
                                       name="nombre_programa"
                                       class="form-control @error('nombre_programa') is-invalid @enderror"
                                       value="{{ old('nombre_programa', $programa->nombre_programa) }}"
                                       placeholder="Ej: Análisis y Desarrollo de Software">
                                @error('nombre_programa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="d-flex justify-content-end align-items-center gap-2">
                        <a href="{{ route('programas.index') }}" class="btn btn-light-secondary px-4 py-2 font-weight-bold me-2">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-success px-4 py-2 font-weight-bold">
                            <i class="fas fa-save me-2"></i>
                            Actualizar Programa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop