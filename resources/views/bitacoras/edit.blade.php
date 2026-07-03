@extends('adminlte::page')

@section('title', 'Editar Bitácora')

@section('content_header')

<h1>Editar Bitácora</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('bitacoras.update', $bitacora) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

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

                        <option value="{{ $estado->id }}" {{ $bitacora->estado_id == $estado->id ? 'selected' : '' }}>

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
                        required
                        value="{{ $bitacora->numero_bitacora }}">

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
                        required
                        value="{{ $bitacora->fecha_limite_entrega }}">

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
                    class="form-control"
                    value="{{ $bitacora->fecha_entrega }}">

            </div>

            <!-- EVIDENCIA -->

            <div class="mb-3">

                <label class="form-label">

                    Evidencia

                </label>

                <input
                    type="file"
                    name="archivo_evidencia_url"
                    class="form-control"
                    value="{{ $bitacora->archivo_evidencia_url }}">

            </div>

            <!-- NOVEDADES -->

            <div class="mb-3">

                <label class="form-label">

                    Novedades

                </label>

                <textarea
                    name="novedades"
                    rows="4"
                    class="form-control">{{ $bitacora->novedades }}</textarea>

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