@extends('adminlte::page')

@section('title', 'Editar Seguimiento')

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

.form-label-custom {
    font-size: 0.85rem;
    font-weight: 700;
    color: #495057;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.4rem;
}

.form-control-custom {
    border-radius: 10px;
    border: 1px solid #ced4da;
    padding: 0.6rem 0.9rem;
    transition: all 0.2s ease;
}

.form-control-custom:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-tasks me-2"></i>
                    Editar Seguimiento #{{ $seguimiento->numero_seguimiento }}
                </h2>
                <p class="text-muted mb-0">
                    <i class="fas fa-user-graduate me-1"></i> Aprendiz: 
                    <strong>
                        {{ $seguimiento->aprendiz->nombres ?? '' }} {{ $seguimiento->aprendiz->apellidos ?? '' }}
                    </strong>
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('seguimientos.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver
                </a>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

<div class="card card-outline card-success shadow-lg border-0 mb-5">
    
    <form action="{{ route('seguimientos.update', $seguimiento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body p-4">
            
            <!-- SECCIÓN 1: APRENDIZ E INSTRUCTOR -->
            <div class="row g-3 mb-3">
                <div class="col-md-6 mb-3">
                    <label for="aprendiz_id" class="form-label-custom">
                        <i class="fas fa-user-graduate text-success me-1"></i> Aprendiz
                    </label>
                    <select name="aprendiz_id" id="aprendiz_id" class="form-control form-control-custom @error('aprendiz_id') is-invalid @enderror" required>
                        <option value="">Seleccione un aprendiz</option>
                        @foreach($aprendices as $aprendiz)
                            <option value="{{ $aprendiz->id }}" {{ old('aprendiz_id', $seguimiento->aprendiz_id) == $aprendiz->id ? 'selected' : '' }}>
                                {{ $aprendiz->nombres }} {{ $aprendiz->apellidos }} - {{ $aprendiz->documento_identidad ?? '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('aprendiz_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="instructor_id" class="form-label-custom">
                        <i class="fas fa-chalkboard-teacher text-success me-1"></i> Instructor
                    </label>
                    <select name="instructor_id" id="instructor_id" class="form-control form-control-custom @error('instructor_id') is-invalid @enderror" required>
                        <option value="">Seleccione un instructor</option>
                        @foreach($instructores as $instructor)
                            <option value="{{ $instructor->id }}" {{ old('instructor_id', $seguimiento->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                {{ $instructor->nombre_completo }}
                            </option>
                        @endforeach
                    </select>
                    @error('instructor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- SECCIÓN 2: ESTADO, NÚMERO Y FECHAS -->
            <div class="row g-3 mb-3">
                <div class="col-md-3 mb-3">
                    <label for="estado_id" class="form-label-custom">
                        <i class="fas fa-info-circle text-success me-1"></i> Estado
                    </label>
                    <select name="estado_id" id="estado_id" class="form-control form-control-custom @error('estado_id') is-invalid @enderror" required>
                        <option value="">Seleccione estado</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}" {{ old('estado_id', $seguimiento->estado_id) == $estado->id ? 'selected' : '' }}>
                                {{ $estado->nombre_estado }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="numero_seguimiento" class="form-label-custom">
                        <i class="fas fa-hashtag text-success me-1"></i> N° Seguimiento
                    </label>
                    <select name="numero_seguimiento" id="numero_seguimiento" class="form-control form-control-custom @error('numero_seguimiento') is-invalid @enderror" required>
                        <option value="1" {{ old('numero_seguimiento', $seguimiento->numero_seguimiento) == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ old('numero_seguimiento', $seguimiento->numero_seguimiento) == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ old('numero_seguimiento', $seguimiento->numero_seguimiento) == 3 ? 'selected' : '' }}>3</option>
                    </select>
                    @error('numero_seguimiento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="fecha_programada" class="form-label-custom">
                        <i class="far fa-calendar-alt text-success me-1"></i> Fecha Programada
                    </label>
                    <input type="date" name="fecha_programada" id="fecha_programada" class="form-control form-control-custom @error('fecha_programada') is-invalid @enderror" value="{{ old('fecha_programada', $seguimiento->fecha_programada) }}" required>
                    @error('fecha_programada')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label for="fecha_realizada" class="form-label-custom">
                        <i class="far fa-calendar-check text-success me-1"></i> Fecha Realizada
                    </label>
                    <input type="date" name="fecha_realizada" id="fecha_realizada" class="form-control form-control-custom @error('fecha_realizada') is-invalid @enderror" value="{{ old('fecha_realizada', $seguimiento->fecha_realizada) }}">
                    @error('fecha_realizada')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- SECCIÓN 3: TEXTAREAS DETALLADAS -->
            <div class="row g-3">
                <div class="col-12 mb-3">
                    <label for="observaciones" class="form-label-custom">
                        <i class="fas fa-comment-alt text-success me-1"></i> Observaciones
                    </label>
                    <textarea name="observaciones" id="observaciones" rows="3" class="form-control form-control-custom @error('observaciones') is-invalid @enderror" placeholder="Ingrese las observaciones del seguimiento...">{{ old('observaciones', $seguimiento->observaciones) }}</textarea>
                    @error('observaciones')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="compromisos" class="form-label-custom">
                        <i class="fas fa-tasks text-success me-1"></i> Compromisos
                    </label>
                    <textarea name="compromisos" id="compromisos" rows="3" class="form-control form-control-custom @error('compromisos') is-invalid @enderror" placeholder="Ingrese los compromisos pactados...">{{ old('compromisos', $seguimiento->compromisos) }}</textarea>
                    @error('compromisos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-3">
                    <label for="recomendaciones" class="form-label-custom">
                        <i class="fas fa-lightbulb text-success me-1"></i> Recomendaciones
                    </label>
                    <textarea name="recomendaciones" id="recomendaciones" rows="3" class="form-control form-control-custom @error('recomendaciones') is-invalid @enderror" placeholder="Ingrese las recomendaciones brindadas...">{{ old('recomendaciones', $seguimiento->recomendaciones) }}</textarea>
                    @error('recomendaciones')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>

        <!-- BOTONES DE ACCIÓN -->
        <div class="card-footer bg-light d-flex justify-content-end gap-2 py-3 px-4" style="border-top: 1px solid #e9ecef;">
            <a href="{{ route('seguimientos.index') }}" class="btn btn-outline-secondary px-4 me-2" style="border-radius: 10px;">
                <i class="fas fa-times me-1"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-success px-4" style="border-radius: 10px; font-weight: 600;">
                <i class="fas fa-save me-1"></i> Actualizar Seguimiento
            </button>
        </div>
    </form>
</div>

@stop