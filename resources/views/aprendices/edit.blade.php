@extends('adminlte::page')

@section('title', 'Editar Aprendiz')

@section('content_header')

    <h1>Editar Aprendiz</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('aprendices.update', $aprendice) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <!-- FICHA -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Ficha

                    </label>

                    <select
                        name="ficha_id"
                        class="form-select @error('ficha_id') is-invalid @enderror">

                        <option value="">

                            Seleccione

                        </option>

                        @foreach($fichas as $ficha)

                            <option value="{{ $ficha->id }}" 
                            {{ $aprendice->ficha_id == $ficha->id ? 'selected' : '' }}>

                                {{ $ficha->numero_ficha }}
                                -
                                {{ $ficha->programa->nombre_programa }}

                            </option>

                        @endforeach

                    </select>

                    @error('ficha_id')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                <!-- ESTADO -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Estado

                    </label>

                    <select
                        name="estado_id"
                        class="form-select">

                        @foreach($estados as $estado)

                            <option
                                value="{{ $estado->id }}"
                                {{ $aprendice->estado_id == $estado->id ? 'selected' : '' }}>

                                {{ $estado->nombre_estado }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- VÍNCULO -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Vínculo Formativo

                    </label>

                    <select
                        name="vinculo_id"
                        class="form-select">

                        @foreach($vinculos as $vinculo)

                            <option
                                value="{{ $vinculo->id }}"
                                {{ $aprendice->vinculo_id == $vinculo->id ? 'selected' : '' }}>

                                {{ $vinculo->nombre_vinculo }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <hr>

            <div class="row">

                <!-- TIPO DOCUMENTO -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Tipo Documento

                    </label>

                    <select
                        name="tipo_documento"
                        class="form-select">

                        <option value="CC" {{ $aprendice->tipo_documento == 'CC' ? 'selected' : '' }}>CC</option>

                        <option value="TI" {{ $aprendice->tipo_documento == 'TI' ? 'selected' : '' }}>TI</option>

                        <option value="CE" {{ $aprendice->tipo_documento == 'CE' ? 'selected' : '' }}>CE</option>

                    </select>

                </div>

                <!-- DOCUMENTO -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Documento

                    </label>

                    <input
                        type="text"
                        name="documento_identidad"
                        class="form-control"
                        value="{{ $aprendice->documento_identidad }}"
                    >

                </div>

                <!-- NOMBRES -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Nombres

                    </label>

                    <input
                        type="text"
                        name="nombres"
                        class="form-control"
                        value="{{ $aprendice->nombres }}"
                    >

                </div>

                <!-- APELLIDOS -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Apellidos

                    </label>

                    <input
                        type="text"
                        name="apellidos"
                        class="form-control"
                        value="{{ $aprendice->apellidos }}" 
                    >

                </div>

            </div>

            <div class="row">

                <!-- CORREO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Correo Electrónico

                    </label>

                    <input
                        type="email"
                        name="correo_electronico"
                        class="form-control"
                        value="{{ $aprendice->correo_electronico }}"
                    >

                </div>

                <!-- TELÉFONO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Teléfono

                    </label>

                    <input
                        type="text"
                        name="telefono"
                        class="form-control"
                        value="{{ $aprendice->telefono }}"
                    >

                </div>

            </div>

            <hr>

            <h5>Información Empresa</h5>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Empresa

                    </label>

                    <input
                        type="text"
                        name="empresa"
                        class="form-control"
                        value="{{ $aprendice->empresa }}"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jefe Inmediato

                    </label>

                    <input
                        type="text"
                        name="jefe_inmediato"
                        class="form-control"
                        value="{{ $aprendice->jefe_inmediato }}"
                    >

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Correo Empresa

                    </label>

                    <input
                        type="email"
                        name="correo_empresa"
                        class="form-control"
                        value="{{ $aprendice->correo_empresa }}"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Teléfono Empresa

                    </label>

                    <input
                        type="text"
                        name="telefono_empresa"
                        class="form-control"
                        value="{{ $aprendice->telefono_empresa }}"
                    >

                </div>

            </div>

            <hr>

            <h5>Etapa Productiva</h5>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Fecha Inicio

                    </label>

                    <input
                        type="date"
                        name="fecha_inicio_practica"
                        class="form-control"
                        value="{{ $aprendice->fecha_inicio_practica }}"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Fecha Fin

                    </label>

                    <input
                        type="date"
                        name="fecha_fin_practica"
                        class="form-control"
                        value="{{ $aprendice->fecha_fin_practica }}"
                    >

                </div>

            </div>

            <!-- DETALLES -->

            <div class="mb-3">

                <label class="form-label">

                    Detalles Contrato

                </label>

                <textarea
                    name="detalles_contrato"
                    rows="4"
                    class="form-control"
                    value="{{ $aprendice->detalles_contrato }}"
                ></textarea>

            </div>

            <button class="btn btn-success">

                Editar Aprendiz

            </button>

            <a href="{{ route('aprendices.index') }}"
               class="btn btn-secondary">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop