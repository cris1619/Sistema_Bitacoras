@extends('adminlte::page')

@section('title', 'Editar Bitácora')

@section('css')
<style>
.content-wrapper {
    background: linear-gradient(135deg, #f8fff9 0%, #f3fbf6 100%);
}

.edit-card {
    border: 1px solid #d8e4dd;
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(25, 135, 84, 0.08);
    background: #ffffff;
    overflow: hidden;
}

.form-label-custom {
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #2f3b46;
    margin-bottom: 0.4rem;
}

.form-control-custom, .form-select-custom {
    border-radius: 10px;
    border: 1px solid #ced4da;
    padding: 0.6rem 1rem;
    transition: all 0.25s ease;
}

.form-control-custom:focus, .form-select-custom:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
}

.btn-custom-save {
    background-color: #198754;
    border-color: #198754;
    border-radius: 10px;
    font-weight: 600;
    padding: 0.6rem 1.5rem;
    transition: all 0.2s ease;
    color: #ffffff;
}

.btn-custom-save:hover {
    background-color: #146c43;
    border-color: #13653f;
    color: #ffffff;
}

.btn-custom-back {
    border-radius: 10px;
    font-weight: 600;
    padding: 0.6rem 1.25rem;
    transition: all 0.2s ease;
}

.evidence-preview-box {
    background-color: #f8fff9;
    border: 1px dashed #198754;
    border-radius: 12px;
    padding: 0.85rem 1.25rem;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-edit me-2"></i>
                    Editar Bitácora #{{ $bitacora->numero_bitacora }}
                </h2>
                <p class="text-muted mb-0">
                    Modifica el estado, las fechas y los soportes de la bitácora asignada.
                </p>
            </div>
            <div>
                <a href="{{ route('bitacoras.index') }}" class="btn btn-outline-secondary btn-custom-back">
                    <i class="fas fa-arrow-left me-1"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@include('partials.alerts')

<div class="card edit-card mb-5">
    <div class="card-body p-4 p-md-5">

        <form action="{{ route('bitacoras.update', $bitacora) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- SECCIÓN 1: ASIGNACIÓN Y ESTADO -->
            <h5 class="text-success fw-bold mb-3">
                <i class="fas fa-user-check me-2"></i> Asignación y Estado
            </h5>

            <div class="row g-3 mb-4">
                <!-- APRENDIZ -->
                <div class="col-md-4">
                    <label class="form-label form-label-custom">
                        <i class="fas fa-user me-1 text-secondary"></i> Aprendiz <span class="text-danger">*</span>
                    </label>
                    <select name="aprendiz_id" class="form-select form-select-custom @error('aprendiz_id') is-invalid @enderror" required>
                        <option value="">-- Seleccione un Aprendiz --</option>
                        @foreach($aprendices as $aprendiz)
                            <option value="{{ $aprendiz->id }}" {{ old('aprendiz_id', $bitacora->aprendiz_id) == $aprendiz->id ? 'selected' : '' }}>
                                {{ $aprendiz->nombres }} {{ $aprendiz->apellidos }}
                            </option>
                        @endforeach
                    </select>
                    @error('aprendiz_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- SEGUIMIENTO -->
                <div class="col-md-4">
                    <label class="form-label form-label-custom">
                        <i class="fas fa-tasks me-1 text-secondary"></i> Seguimiento Asociado
                    </label>
                    <select name="seguimiento_id" class="form-select form-select-custom @error('seguimiento_id') is-invalid @enderror">
                        <option value="">-- Ninguno (Opcional) --</option>
                        @foreach($seguimientos as $seguimiento)
                            <option value="{{ $seguimiento->id }}" {{ old('seguimiento_id', $bitacora->seguimiento_id) == $seguimiento->id ? 'selected' : '' }}>
                                Seguimiento #{{ $seguimiento->numero_seguimiento }}
                            </option>
                        @endforeach
                    </select>
                    @error('seguimiento_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- ESTADO -->
                <div class="col-md-4">
                    <label class="form-label form-label-custom">
                        <i class="fas fa-flag me-1 text-secondary"></i> Estado de Bitácora <span class="text-danger">*</span>
                    </label>
                    <select name="estado_id" class="form-select form-select-custom @error('estado_id') is-invalid @enderror" required>
                        <option value="">-- Seleccione Estado --</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}" {{ old('estado_id', $bitacora->estado_id) == $estado->id ? 'selected' : '' }}>
                                {{ $estado->nombre_estado }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4" style="border-color: #e1ebe5;">

            <!-- SECCIÓN 2: CONTROL Y TIEMPOS -->
            <h5 class="text-success fw-bold mb-3">
                <i class="fas fa-calendar-alt me-2"></i> Tiempos y Control
            </h5>

            <div class="row g-3 mb-4">
                <!-- NUMERO DE BITÁCORA -->
                <div class="col-md-4">
                    <label class="form-label form-label-custom">
                        <i class="fas fa-hashtag me-1 text-secondary"></i> Número Bitácora <span class="text-danger">*</span>
                    </label>
                    <input type="number"
                           name="numero_bitacora"
                           class="form-control form-control-custom @error('numero_bitacora') is-invalid @enderror"
                           required
                           min="1"
                           value="{{ old('numero_bitacora', $bitacora->numero_bitacora) }}">
                    @error('numero_bitacora')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- FECHA LIMITE -->
                <div class="col-md-4">
                    <label class="form-label form-label-custom">
                        <i class="far fa-calendar-times me-1 text-secondary"></i> Fecha Límite de Entrega <span class="text-danger">*</span>
                    </label>
                    <input type="date"
                           name="fecha_limite_entrega"
                           class="form-control form-control-custom @error('fecha_limite_entrega') is-invalid @enderror"
                           required
                           value="{{ old('fecha_limite_entrega', \Carbon\Carbon::parse($bitacora->fecha_limite_entrega)->format('Y-m-d')) }}">
                    @error('fecha_limite_entrega')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- FECHA ENTREGA REAL -->
                <div class="col-md-4">
                    <label class="form-label form-label-custom">
                        <i class="far fa-calendar-check me-1 text-secondary"></i> Fecha Entrega Real
                    </label>
                    <input type="date"
                           name="fecha_entrega"
                           class="form-control form-control-custom @error('fecha_entrega') is-invalid @enderror"
                           value="{{ old('fecha_entrega', $bitacora->fecha_entrega ? \Carbon\Carbon::parse($bitacora->fecha_entrega)->format('Y-m-d') : '') }}">
                    @error('fecha_entrega')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-4" style="border-color: #e1ebe5;">

            <!-- SECCIÓN 3: EVIDENCIA Y OBSERVACIONES -->
            <h5 class="text-success fw-bold mb-3">
                <i class="fas fa-paperclip me-2"></i> Evidencias y Observaciones
            </h5>

            <div class="row g-3 mb-4">
                <!-- EVIDENCIA -->
                <div class="col-md-12 mb-2">
                    <label class="form-label form-label-custom">
                        <i class="fas fa-file-upload me-1 text-secondary"></i> Actualizar Documento Evidencia
                    </label>

                    @if($bitacora->archivo_evidencia_url)
                        <div class="evidence-preview-box d-flex align-items-center justify-content-between mb-2">
                            <span class="small text-dark font-weight-bold">
                                <i class="fas fa-file-pdf text-danger me-1"></i> Evidencia cargada actualmente
                            </span>
                            <a href="{{ asset('storage/' . $bitacora->archivo_evidencia_url) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-success border-0 fw-bold">
                                <i class="fas fa-external-link-alt me-1"></i> Ver archivo
                            </a>
                        </div>
                    @endif

                    <input type="file"
                           name="archivo_evidencia_url"
                           class="form-control form-control-custom @error('archivo_evidencia_url') is-invalid @enderror">
                    <small class="text-muted d-block mt-1">
                        Suba un nuevo archivo únicamente si desea reemplazar el documento existente.
                    </small>
                    @error('archivo_evidencia_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NOVEDADES -->
                <div class="col-md-12">
                    <label class="form-label form-label-custom">
                        <i class="fas fa-comment-alt me-1 text-secondary"></i> Novedades u Observaciones
                    </label>
                    <textarea name="novedades"
                              rows="4"
                              class="form-control form-control-custom @error('novedades') is-invalid @enderror"
                              placeholder="Escriba observaciones, correcciones o detalles del avance...">{{ old('novedades', $bitacora->novedades) }}</textarea>
                    @error('novedades')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- BOTONES DE ACCIÓN -->
            <div class="d-flex align-items-center justify-content-end gap-2 mt-4 pt-3 border-top">
                <a href="{{ route('bitacoras.index') }}" class="btn btn-secondary btn-custom-back me-2">
                    <i class="fas fa-times me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-custom-save">
                    <i class="fas fa-save me-1"></i> Guardar Cambios
                </button>
            </div>

        </form>

    </div>
</div>

@stop