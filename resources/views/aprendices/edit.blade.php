@extends('adminlte::page')

@section('title', 'Editar Aprendiz')

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
                    <i class="fas fa-user-edit me-2"></i>
                    Editar Aprendiz: {{ $aprendice->nombres }} {{ $aprendice->apellidos }}
                </h2>
                <p class="text-muted mb-0">
                    <i class="fas fa-id-card me-1"></i> {{ $aprendice->tipo_documento }}: <strong>{{ $aprendice->documento_identidad }}</strong>
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('aprendices.show', $aprendice->id) }}" class="btn btn-outline-info px-4 py-2" style="border-radius: 10px;">
                    <i class="fas fa-eye me-2"></i>
                    Ver Detalle
                </a>
                <a href="{{ route('aprendices.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
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
    
    <form action="{{ route('aprendices.update', $aprendice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pestañas de Navegación -->
        <ul class="nav nav-tabs nav-tabs-custom" id="aprendizEditTab" role="tablist">
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
            <div class="tab-content" id="aprendizEditTabContent">
                
                <!-- TAB 1: INFORMACIÓN ACADÉMICA -->
                <div class="tab-pane fade show active" id="academica" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="ficha_id" class="form-label-custom"><i class="fas fa-layer-group text-success me-1"></i> Ficha de Formación</label>
                            <select name="ficha_id" id="ficha_id" class="form-control form-control-custom @error('ficha_id') is-invalid @enderror">
                                <option value="">Seleccione una ficha</option>
                                @foreach($fichas as $ficha)
                                    <option value="{{ $ficha->id }}" {{ old('ficha_id', $aprendice->ficha_id) == $ficha->id ? 'selected' : '' }}>
                                        {{ $ficha->numero_ficha }} - {{ $ficha->programa->nombre_programa ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ficha_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="estado_id" class="form-label-custom"><i class="fas fa-info-circle text-success me-1"></i> Estado del Aprendiz</label>
                            <select name="estado_id" id="estado_id" class="form-control form-control-custom @error('estado_id') is-invalid @enderror">
                                <option value="">Seleccione estado</option>
                                @foreach($estados as $estado)
                                    <option value="{{ $estado->id }}" {{ old('estado_id', $aprendice->estado_id) == $estado->id ? 'selected' : '' }}>
                                        {{ $estado->nombre_estado }}
                                    </option>
                                @endforeach
                            </select>
                            @error('estado_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="vinculo_id" class="form-label-custom"><i class="fas fa-link text-success me-1"></i> Vínculo Formativo</label>
                            <select name="vinculo_id" id="vinculo_id" class="form-control form-control-custom @error('vinculo_id') is-invalid @enderror">
                                <option value="">Seleccione vínculo</option>
                                @foreach($vinculos as $vinculo)
                                    <option value="{{ $vinculo->id }}" {{ old('vinculo_id', $aprendice->vinculo_id) == $vinculo->id ? 'selected' : '' }}>
                                        {{ $vinculo->nombre_vinculo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vinculo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- TAB 2: INFORMACIÓN PERSONAL -->
                <div class="tab-pane fade" id="personal" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-3 mb-3">
                            <label for="tipo_documento" class="form-label-custom"><i class="fas fa-address-card text-success me-1"></i> Tipo Documento</label>
                            <select name="tipo_documento" id="tipo_documento" class="form-control form-control-custom @error('tipo_documento') is-invalid @enderror">
                                <option value="CC" {{ old('tipo_documento', $aprendice->tipo_documento) == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía (CC)</option>
                                <option value="TI" {{ old('tipo_documento', $aprendice->tipo_documento) == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad (TI)</option>
                                <option value="CE" {{ old('tipo_documento', $aprendice->tipo_documento) == 'CE' ? 'selected' : '' }}>Cédula de Extranjería (CE)</option>
                                <option value="PEP" {{ old('tipo_documento', $aprendice->tipo_documento) == 'PEP' ? 'selected' : '' }}>PEP</option>
                                <option value="PPT" {{ old('tipo_documento', $aprendice->tipo_documento) == 'PPT' ? 'selected' : '' }}>PPT</option>
                            </select>
                            @error('tipo_documento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="documento_identidad" class="form-label-custom"><i class="fas fa-hashtag text-success me-1"></i> Número de Documento</label>
                            <input type="text" name="documento_identidad" id="documento_identidad" class="form-control form-control-custom @error('documento_identidad') is-invalid @enderror" value="{{ old('documento_identidad', $aprendice->documento_identidad) }}">
                            @error('documento_identidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="nombres" class="form-label-custom"><i class="fas fa-user text-success me-1"></i> Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control form-control-custom @error('nombres') is-invalid @enderror" value="{{ old('nombres', $aprendice->nombres) }}">
                            @error('nombres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="apellidos" class="form-label-custom"><i class="fas fa-user text-success me-1"></i> Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control form-control-custom @error('apellidos') is-invalid @enderror" value="{{ old('apellidos', $aprendice->apellidos) }}">
                            @error('apellidos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="correo_electronico" class="form-label-custom"><i class="far fa-envelope text-success me-1"></i> Correo Electrónico</label>
                            <input type="email" name="correo_electronico" id="correo_electronico" class="form-control form-control-custom @error('correo_electronico') is-invalid @enderror" value="{{ old('correo_electronico', $aprendice->correo_electronico) }}">
                            @error('correo_electronico')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label-custom"><i class="fas fa-phone-alt text-success me-1"></i> Teléfono / Celular</label>
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-custom @error('telefono') is-invalid @enderror" value="{{ old('telefono', $aprendice->telefono) }}">
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- TAB 3: INFORMACIÓN EMPRESA -->
                <div class="tab-pane fade" id="empresa" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="empresa" class="form-label-custom"><i class="fas fa-industry text-success me-1"></i> Nombre de la Empresa</label>
                            <input type="text" name="empresa" id="empresa" class="form-control form-control-custom @error('empresa') is-invalid @enderror" value="{{ old('empresa', $aprendice->empresa) }}">
                            @error('empresa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="jefe_inmediato" class="form-label-custom"><i class="fas fa-user-tie text-success me-1"></i> Jefe Inmediato</label>
                            <input type="text" name="jefe_inmediato" id="jefe_inmediato" class="form-control form-control-custom @error('jefe_inmediato') is-invalid @enderror" value="{{ old('jefe_inmediato', $aprendice->jefe_inmediato) }}">
                            @error('jefe_inmediato')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="correo_empresa" class="form-label-custom"><i class="far fa-envelope text-success me-1"></i> Correo de la Empresa</label>
                            <input type="email" name="correo_empresa" id="correo_empresa" class="form-control form-control-custom @error('correo_empresa') is-invalid @enderror" value="{{ old('correo_empresa', $aprendice->correo_empresa) }}">
                            @error('correo_empresa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telefono_empresa" class="form-label-custom"><i class="fas fa-phone-alt text-success me-1"></i> Teléfono de la Empresa</label>
                            <input type="text" name="telefono_empresa" id="telefono_empresa" class="form-control form-control-custom @error('telefono_empresa') is-invalid @enderror" value="{{ old('telefono_empresa', $aprendice->telefono_empresa) }}">
                            @error('telefono_empresa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- TAB 4: ETAPA PRODUCTIVA -->
                <div class="tab-pane fade" id="productiva" role="tabpanel">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_inicio_practica" class="form-label-custom"><i class="far fa-calendar-alt text-success me-1"></i> Fecha Inicio Práctica</label>
                            <input type="date" name="fecha_inicio_practica" id="fecha_inicio_practica" class="form-control form-control-custom @error('fecha_inicio_practica') is-invalid @enderror" value="{{ old('fecha_inicio_practica', $aprendice->fecha_inicio_practica) }}">
                            @error('fecha_inicio_practica')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fecha_fin_practica" class="form-label-custom"><i class="far fa-calendar-check text-success me-1"></i> Fecha Fin Práctica</label>
                            <input type="date" name="fecha_fin_practica" id="fecha_fin_practica" class="form-control form-control-custom @error('fecha_fin_practica') is-invalid @enderror" value="{{ old('fecha_fin_practica', $aprendice->fecha_fin_practica) }}">
                            @error('fecha_fin_practica')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="detalles_contrato" class="form-label-custom"><i class="fas fa-file-contract text-success me-1"></i> Detalles del Contrato / Observaciones</label>
                            <textarea name="detalles_contrato" id="detalles_contrato" rows="4" class="form-control form-control-custom @error('detalles_contrato') is-invalid @enderror" placeholder="Ingrese las observaciones o cláusulas especiales...">{{ old('detalles_contrato', $aprendice->detalles_contrato) }}</textarea>
                            @error('detalles_contrato')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="card-footer bg-light d-flex justify-content-end gap-2 py-3 px-4" style="border-top: 1px solid #e9ecef;">
            <a href="{{ route('aprendices.index') }}" class="btn btn-outline-secondary px-4 me-2" style="border-radius: 10px;">
                <i class="fas fa-times me-1"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-success px-4" style="border-radius: 10px; font-weight: 600;">
                <i class="fas fa-save me-1"></i> Actualizar Aprendiz
            </button>
        </div>
    </form>
</div>

@stop