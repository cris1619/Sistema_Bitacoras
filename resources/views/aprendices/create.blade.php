@extends('adminlte::page')

@section('title', 'Nuevo Aprendiz')

@section('content_header')

    <h1>Registrar Aprendiz</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('aprendices.store') }}"
            method="POST">

            @csrf

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

                            <option value="{{ $ficha->id }}">

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

                            <option value="{{ $estado->id }}">

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

                            <option value="{{ $vinculo->id }}">

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

                        <option value="CC">CC</option>

                        <option value="TI">TI</option>

                        <option value="CE">CE</option>

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
                    class="form-control"></textarea>

            </div>

            <button class="btn btn-success">

                Guardar Aprendiz

            </button>

            <a href="{{ route('aprendices.index') }}"
               class="btn btn-secondary">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop