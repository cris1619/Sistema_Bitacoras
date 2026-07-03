@extends('adminlte::page')

@section('title', 'Nueva Bitácora')

@section('content_header')

<h1>Nueva Bitácora</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('bitacoras.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="row">

                <!-- APRENDIZ -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Aprendiz

                    </label>

                    <select
                        name="aprendiz_id"
                        class="form-select"
                        required>

                        <option value="">

                            Seleccione

                        </option>

                        @foreach($aprendices as $aprendiz)

                        <option value="{{ $aprendiz->id }}">

                            {{ $aprendiz->nombres }}
                            {{ $aprendiz->apellidos }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- SEGUIMIENTO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Seguimiento

                    </label>

                    <select
                        name="seguimiento_id"
                        class="form-select">

                        <option value="">

                            Seleccione

                        </option>

                        @foreach($seguimientos as $seguimiento)

                        <option value="{{ $seguimiento->id }}">

                            Seguimiento
                            {{ $seguimiento->numero_seguimiento }}

                        </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- ESTADO -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Estado

                    </label>

                    <select
                        name="estado_id"
                        class="form-select"
                        required>

                        <option value="">

                            Seleccione

                        </option>

                        @foreach($estados as $estado)

                        <option value="{{ $estado->id }}">

                            {{ $estado->nombre_estado }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- NUMERO -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Número Bitácora

                    </label>

                    <input
                        type="number"
                        name="numero_bitacora"
                        class="form-control"
                        required>

                </div>

                <!-- FECHA LIMITE -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Fecha Límite

                    </label>

                    <input
                        type="date"
                        name="fecha_limite_entrega"
                        class="form-control"
                        required>

                </div>

            </div>

            <!-- FECHA ENTREGA -->

            <div class="mb-3">

                <label class="form-label">

                    Fecha Entrega

                </label>

                <input
                    type="date"
                    name="fecha_entrega"
                    class="form-control">

            </div>

            <!-- EVIDENCIA -->

            <div class="mb-3">

                <label class="form-label">

                    Evidencia

                </label>

                <input
                    type="file"
                    name="archivo_evidencia_url"
                    class="form-control">

            </div>

            <!-- NOVEDADES -->

            <div class="mb-3">

                <label class="form-label">

                    Novedades

                </label>

                <textarea
                    name="novedades"
                    rows="4"
                    class="form-control"></textarea>

            </div>

            <button
                class="btn btn-primary">

                Guardar

            </button>

            <a href="{{ route('bitacoras.index') }}"
               class="btn btn-secondary">

                Volver

            </a>

        </form>

    </div>

</div>

@stop