@extends('adminlte::page')

@section('title', 'Registrar Aprendiz')

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
.form-select,
textarea {
    min-height: 46px;
    border: 1px solid #d8e4dd;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 500;
    padding: 0.72rem 0.9rem;
    transition: all .25s ease;
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

/* Homologación Select2 */
.select2-container--default .select2-selection--single {
    height: 46px !important;
    min-height: 46px !important;
    border: 1px solid #d8e4dd !important;
    border-radius: 12px !important;
    background-color: #ffffff !important;
    padding: 0.2rem 0.5rem !important;
    transition: all .25s ease;
}

.select2-container--default:hover .select2-selection--single {
    border-color: #198754 !important;
}

.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default.select2-container--open .select2-selection--single {
    border-color: #198754 !important;
    box-shadow: 0 0 0 .2rem rgba(25, 135, 84, .15) !important;
    outline: none;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #2f3b46 !important;
    font-size: 0.95rem !important;
    font-weight: 500 !important;
    line-height: 38px !important;
    padding-left: 0.4rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #6c757d !important;
    font-weight: 400 !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 44px !important;
    right: 8px !important;
}

.select2-dropdown {
    border: 1px solid #198754 !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    overflow: hidden;
    z-index: 1056;
}

.select2-container--default .select2-search--dropdown .select2-search__field {
    border: 1px solid #d8e4dd !important;
    border-radius: 8px !important;
    padding: 0.4rem 0.7rem !important;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #198754 !important;
    color: #ffffff !important;
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
                    Complete la información académica, personal, empresarial y de etapa productiva.
                </p>
            </div>
            <a href="{{ route('aprendices.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
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

<form action="{{ route('aprendices.store') }}" method="POST">
    @csrf

    <div class="card card-outline card-success shadow-lg border-0 mb-4">
        
        <!-- Tabs Header -->
        <ul class="nav nav-tabs nav-tabs-custom" id="aprendizTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="academica-tab" data-toggle="tab" data-target="#academica" type="button" role="tab">
                    <i class="fas fa-graduation-cap me-2"></i>Información Académica
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="personal-tab" data-toggle="tab" data-target="#personal" type="button" role="tab">
                    <i class="fas fa-id-card me-2"></i>Información Personal
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="empresa-tab" data-toggle="tab" data-target="#empresa" type="button" role="tab">
                    <i class="fas fa-building me-2"></i>Información Empresa
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="productiva-tab" data-toggle="tab" data-target="#productiva" type="button" role="tab">
                    <i class="fas fa-briefcase me-2"></i>Etapa Productiva
                </button>
            </li>
        </ul>

        <div class="card-body p-4">
            <div class="tab-content" id="aprendizTabContent">
                
                <!-- TAB 1: INFORMACIÓN ACADÉMICA -->
                <div class="tab-pane fade show active" id="academica" role="tabpanel">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Ficha <span class="text-danger">*</span></label>
                            <select name="ficha_id" class="form-select select2 @error('ficha_id') is-invalid @enderror">
                                <option value="">Buscar por número o programa...</option>
                                @foreach($fichas as $ficha)
                                    <option value="{{ $ficha->id }}" 
                                            data-search="{{ $ficha->numero_ficha }} {{ $ficha->programa->nombre_programa ?? '' }}"
                                            {{ old('ficha_id') == $ficha->id ? 'selected' : '' }}>
                                        {{ $ficha->numero_ficha }} - {{ $ficha->programa->nombre_programa ?? 'Sin programa' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Estado</label>
                            <select name="estado_id" class="form-select select2">
                                <option value="">Seleccione un estado</option>
                                @foreach($estados as $estado)
                                    <option value="{{ $estado->id }}" {{ old('estado_id') == $estado->id ? 'selected' : '' }}>
                                        {{ $estado->nombre_estado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Vínculo Formativo</label>
                            <select name="vinculo_id" class="form-select select2">
                                <option value="">Seleccione un vínculo</option>
                                @foreach($vinculos as $vinculo)
                                    <option value="{{ $vinculo->id }}" {{ old('vinculo_id') == $vinculo->id ? 'selected' : '' }}>
                                        {{ $vinculo->nombre_vinculo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-outline-success px-4 btn-next" data-next="#personal-tab">
                            Siguiente <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- TAB 2: INFORMACIÓN PERSONAL -->
                <div class="tab-pane fade" id="personal" role="tabpanel">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Tipo Documento <span class="text-danger">*</span></label>
                            <select name="tipo_documento" class="form-select select2">
                                <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>CC - Cédula de Ciudadanía</option>
                                <option value="TI" {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}>TI - Tarjeta de Identidad</option>
                                <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>CE - Cédula de Extranjería</option>
                                <option value="PEP" {{ old('tipo_documento') == 'PEP' ? 'selected' : '' }}>PEP</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Documento <span class="text-danger">*</span></label>
                            <input type="text" name="documento_identidad" value="{{ old('documento_identidad') }}" class="form-control" placeholder="Ej: 1098765432">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Nombres <span class="text-danger">*</span></label>
                            <input type="text" name="nombres" value="{{ old('nombres') }}" class="form-control" placeholder="Nombres completos">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Apellidos <span class="text-danger">*</span></label>
                            <input type="text" name="apellidos" value="{{ old('apellidos') }}" class="form-control" placeholder="Apellidos completos">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Correo Electrónico <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="far fa-envelope text-muted"></i></span>
                                <input type="email" name="correo_electronico" value="{{ old('correo_electronico') }}" class="form-control border-start-0" placeholder="aprendiz@soy.sena.edu.co">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Teléfono</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fas fa-phone-alt text-muted"></i></span>
                                <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control border-start-0" placeholder="Ej: 3001234567">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary px-4 btn-prev" data-prev="#academica-tab">
                            <i class="fas fa-arrow-left me-2"></i> Anterior
                        </button>
                        <button type="button" class="btn btn-outline-success px-4 btn-next" data-next="#empresa-tab">
                            Siguiente <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- TAB 3: INFORMACIÓN EMPRESA -->
                <div class="tab-pane fade" id="empresa" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Empresa</label>
                            <input type="text" name="empresa" value="{{ old('empresa') }}" class="form-control" placeholder="Nombre de la empresa patrocinadora">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Jefe Inmediato</label>
                            <input type="text" name="jefe_inmediato" value="{{ old('jefe_inmediato') }}" class="form-control" placeholder="Nombre del responsable">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Correo Empresa</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="far fa-envelope text-muted"></i></span>
                                <input type="email" name="correo_empresa" value="{{ old('correo_empresa') }}" class="form-control border-start-0" placeholder="contacto@empresa.com">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Teléfono Empresa</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="fas fa-phone-alt text-muted"></i></span>
                                <input type="text" name="telefono_empresa" value="{{ old('telefono_empresa') }}" class="form-control border-start-0" placeholder="Ej: 6076543210">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary px-4 btn-prev" data-prev="#personal-tab">
                            <i class="fas fa-arrow-left me-2"></i> Anterior
                        </button>
                        <button type="button" class="btn btn-outline-success px-4 btn-next" data-next="#productiva-tab">
                            Siguiente <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- TAB 4: ETAPA PRODUCTIVA -->
                <div class="tab-pane fade" id="productiva" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Fecha Inicio</label>
                            <input type="date" name="fecha_inicio_practica" value="{{ old('fecha_inicio_practica') }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Fecha Fin</label>
                            <input type="date" name="fecha_fin_practica" value="{{ old('fecha_fin_practica') }}" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Detalles Contrato</label>
                        <textarea name="detalles_contrato" rows="4" class="form-control" placeholder="Observaciones o términos del contrato...">{{ old('detalles_contrato') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary px-4 btn-prev" data-prev="#empresa-tab">
                            <i class="fas fa-arrow-left me-2"></i> Anterior
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ACCIONES DEL FORMULARIO -->
    <div class="d-flex align-items-center justify-content-end gap-2 mb-5">
        <a href="{{ route('aprendices.index') }}" class="btn btn-light px-4 py-2 font-weight-bold text-secondary me-2" style="border-radius: 12px;">
            Cancelar
        </a>
        <button type="submit" class="btn btn-success px-5 py-2 font-weight-bold">
            <i class="fas fa-save me-2"></i>
            Guardar Aprendiz
        </button>
    </div>
</form>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    // Inicialización de Select2 con matcher personalizado
    $('.select2').select2({
        width: '100%',
        placeholder: "Seleccione una opción...",
        allowClear: true,
        matcher: function(params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }
            if (typeof data.text === 'undefined') {
                return null;
            }
            var searchTerm = params.term.toLowerCase();
            var optionText = data.text.toLowerCase();
            var customSearch = $(data.element).data('search');

            if (optionText.indexOf(searchTerm) > -1 || (customSearch && customSearch.toLowerCase().indexOf(searchTerm) > -1)) {
                return data;
            }
            return null;
        }
    });

    // Navegación fluida entre pestañas
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