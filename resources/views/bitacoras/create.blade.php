@extends('adminlte::page')

@section('title', 'Nueva Bitácora')

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
                    <i class="fas fa-book me-2"></i>
                    Nueva Bitácora
                </h2>
                <p class="text-muted mb-0">
                    Registre la información de la bitácora con una presentación más clara y profesional.
                </p>
            </div>
            <a href="{{ route('bitacoras.index') }}" class="btn btn-outline-secondary">
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
        <form action="{{ route('bitacoras.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-info-circle me-2"></i>
                    Información General
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Aprendiz</label>
                            <select name="aprendiz_id" class="form-select" required>
                                <option value="">Seleccione</option>
                                @foreach($aprendices as $aprendiz)
                                    <option value="{{ $aprendiz->id }}">{{ $aprendiz->nombres }} {{ $aprendiz->apellidos }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Seguimiento</label>
                            <select name="seguimiento_id" class="form-select">
                                <option value="">Seleccione</option>
                                @foreach($seguimientos as $seguimiento)
                                    <option value="{{ $seguimiento->id }}">Seguimiento {{ $seguimiento->numero_seguimiento }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Estado</label>
                            <select name="estado_id" class="form-select" required>
                                <option value="">Seleccione</option>
                                @foreach($estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->nombre_estado }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Número Bitácora</label>
                            <input type="number" name="numero_bitacora" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Fecha Límite</label>
                            <input type="date" name="fecha_limite_entrega" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Fecha Entrega</label>
                        <input type="date" name="fecha_entrega" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Evidencia</label>
                        <input type="file" name="archivo_evidencia_url" class="form-control">
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-edit me-2"></i>
                    Detalles de la Bitácora
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Novedades</label>
                        <textarea name="novedades" rows="4" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="{{ route('bitacoras.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="fas fa-times me-2"></i>
                    Volver
                </a>
                <button class="btn btn-success btn-lg px-4">
                    <i class="fas fa-save me-2"></i>
                    Guardar
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