@extends('adminlte::page')

@section('title', 'Editar Instructor')

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

.nav-tabs-custom {
    border-bottom: 2px solid #e9ecef;
    background: #f8f9fa;
    padding: 0.5rem 0.5rem 0 0.5rem;
    border-radius: 18px 18px 0 0;
}

.nav-tabs-custom .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 600;
    padding: 0.8rem 1.25rem;
    border-radius: 10px 10px 0 0;
    transition: all 0.25s ease;
    margin-right: 0.25rem;
}

.nav-tabs-custom .nav-link:hover {
    color: #198754;
    background: rgba(25, 135, 84, 0.05);
}

.nav-tabs-custom .nav-link.active {
    color: #198754;
    background: #ffffff;
    border-bottom: 3px solid #198754;
    font-weight: 700;
}

.form-control,
.form-select {
    min-height: 46px;
    border: 1px solid #d8e4dd;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 500;
    padding: 0.72rem 0.9rem;
    transition: all .25s ease;
}

.form-control:hover,
.form-select:hover {
    border-color: #198754;
}

.form-control:focus,
.form-select:focus {
    border-color: #198754;
    box-shadow: 0 0 0 .2rem rgba(25, 135, 84, .15);
}

label {
    font-weight: 700;
    color: #2f3b46;
    margin-bottom: 0.55rem;
    font-size: 0.9rem;
}

.btn-success {
    background: linear-gradient(135deg, #1e9d5b 0%, #198754 100%);
    border: 0;
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.18);
    border-radius: 12px;
}

.btn-success:hover {
    transform: translateY(-1px);
}

/* Select2 Custom Styles */
.select2-container--default .select2-selection--single,
.select2-container--default .select2-selection--multiple {
    min-height: 46px;
    border: 1px solid #d8e4dd;
    border-radius: 12px;
    padding: 4px 8px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 36px !important;
    color: #495057;
}

.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #198754;
    box-shadow: 0 0 0 .2rem rgba(25,135,84,.15);
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #e8f5e9;
    border: 1px solid #c8e6c9;
    color: #1b5e20;
    border-radius: 6px;
    padding: 2px 8px;
    font-weight: 600;
    font-size: 0.85rem;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #1b5e20;
    margin-right: 5px;
}
</style>
@stop

@section('content_header')
<div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%); border-radius: 18px;">
    <div class="card-body py-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="text-success mb-2 fw-bold">
                    <i class="fas fa-user-edit me-2"></i>
                    Editar Instructor
                </h2>
                <p class="text-muted mb-0">
                    Modifique la información personal o actualice los programas asignados.
                </p>
            </div>
            <a href="{{ route('instructores.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
                <i class="fas fa-arrow-left me-2"></i>
                Volver
            </a>
        </div>
    </div>
</div>
@stop

@section('content')

@if ($errors->any())
<div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
    <h5 class="mb-2"><i class="fas fa-ban me-2"></i>Se encontraron errores en el formulario</h5>
    <ul class="mb-0 ps-3">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('instructores.update', $instructor->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card card-outline card-success shadow-lg border-0 mb-4">
        
        <!-- Tabs Header -->
        <ul class="nav nav-tabs nav-tabs-custom" id="instructorTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="personal-tab" data-toggle="tab" data-target="#personal" type="button" role="tab">
                    <i class="fas fa-id-card me-2"></i>Información Personal
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contacto-tab" data-toggle="tab" data-target="#contacto" type="button" role="tab">
                    <i class="fas fa-address-book me-2"></i>Contacto
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="programas-tab" data-toggle="tab" data-target="#programas" type="button" role="tab">
                    <i class="fas fa-graduation-cap me-2"></i>Programas de Formación
                </button>
            </li>
        </ul>

        <div class="card-body p-4">
            <div class="tab-content" id="instructorTabContent">
                
                <!-- TAB 1: INFORMACIÓN PERSONAL -->
                <div class="tab-pane fade show active" id="personal" role="tabpanel">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Tipo de Documento <span class="text-danger">*</span></label>
                            <select name="tipo_documento" class="form-select select2 @error('tipo_documento') is-invalid @enderror" required>
                                <option value="">Seleccione...</option>
                                <option value="CC" {{ old('tipo_documento', $instructor->tipo_documento) == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                                <option value="TI" {{ old('tipo_documento', $instructor->tipo_documento) == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                                <option value="CE" {{ old('tipo_documento', $instructor->tipo_documento) == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Número de Documento <span class="text-danger">*</span></label>
                            <input type="text" name="documento_identidad" class="form-control @error('documento_identidad') is-invalid @enderror" value="{{ old('documento_identidad', $instructor->documento_identidad) }}" maxlength="20" placeholder="Ej: 1098765432" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Nombres <span class="text-danger">*</span></label>
                            <input type="text" name="nombres" class="form-control @error('nombres') is-invalid @enderror" value="{{ old('nombres', $instructor->nombres) }}" maxlength="100" placeholder="Ingrese nombres" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Apellidos <span class="text-danger">*</span></label>
                            <input type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos', $instructor->apellidos) }}" maxlength="100" placeholder="Ingrese apellidos" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-outline-success px-4 btn-next" data-next="#contacto-tab">
                            Siguiente <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- TAB 2: CONTACTO -->
                <div class="tab-pane fade" id="contacto" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Correo Electrónico <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="far fa-envelope text-muted"></i></span>
                                <input type="email" name="correo_electronico" class="form-control border-start-0 @error('correo_electronico') is-invalid @enderror" value="{{ old('correo_electronico', $instructor->correo_electronico) }}" placeholder="instructor@sena.edu.co" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Teléfono / Celular</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fas fa-phone-alt text-muted"></i></span>
                                <input type="text" name="telefono" class="form-control border-start-0 @error('telefono') is-invalid @enderror" value="{{ old('telefono', $instructor->telefono) }}" maxlength="20" placeholder="Ej: 3001234567">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary px-4 btn-prev" data-prev="#personal-tab">
                            <i class="fas fa-arrow-left me-2"></i> Anterior
                        </button>
                        <button type="button" class="btn btn-outline-success px-4 btn-next" data-next="#programas-tab">
                            Siguiente <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- TAB 3: PROGRAMAS DE FORMACIÓN -->
                <div class="tab-pane fade" id="programas" role="tabpanel">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label>Programas de Formación Asignados <span class="text-danger">*</span></label>
                            <select name="programas[]" id="programas_select" class="form-control select2-multiple @error('programas') is-invalid @enderror" multiple="multiple" data-placeholder="Busque y seleccione los programas..." required>
                                @foreach($programas as $programa)
                                    <option value="{{ $programa->id }}" @selected(collect(old('programas', $instructor->programas->pluck('id')))->contains($programa->id))>
                                        {{ $programa->nombre_programa }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i> Puede seleccionar o quitar varios programas interactuando con las opciones.
                            </small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary px-4 btn-prev" data-prev="#contacto-tab">
                            <i class="fas fa-arrow-left me-2"></i> Anterior
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- BOTONES PRINCIPALES DE ACCIÓN -->
    <div class="d-flex align-items-center justify-content-end gap-2 mb-5">
        <a href="{{ route('instructores.index') }}" class="btn btn-light px-4 py-2 font-weight-bold text-secondary me-2" style="border-radius: 12px;">
            Cancelar
        </a>
        <button type="submit" class="btn btn-success px-5 py-2 font-weight-bold">
            <i class="fas fa-sync-alt me-2"></i>
            Actualizar Instructor
        </button>
    </div>
</form>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(function () {
    // Inicializar Select2 individual
    $('.select2').select2({
        width: '100%',
        minimumResultsForSearch: 6
    });

    // Inicializar Select2 Múltiple para programas
    $('.select2-multiple').select2({
        width: '100%',
        placeholder: "Busque y seleccione los programas...",
        allowClear: true
    });

    // Navegación asistida entre pestañas
    $('.btn-next').on('click', function () {
        var targetTab = $(this).data('next');
        $(targetTab).tab('show');
    });

    $('.btn-prev').on('click', function () {
        var targetTab = $(this).data('prev');
        $(targetTab).tab('show');
    });
});
</script>
@stop