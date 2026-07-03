@extends('adminlte::page')

@section('title', 'Nuevo Seguimiento')

@section('content_header')

<h1>Nuevo Seguimiento</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('seguimientos.update', $seguimiento->id) }}"
            method="POST">

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

                        <option value="{{ $aprendiz->id }}" {{ $seguimiento->aprendiz_id == $aprendiz->id ? 'selected' : '' }}>

                            {{ $aprendiz->nombres }}
                            {{ $aprendiz->apellidos }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- INSTRUCTOR -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Instructor

                    </label>

                    <select
                        name="instructor_id"
                        class="form-select"
                        required>

                        <option value="">

                            Seleccione

                        </option>

                        @foreach($instructores as $instructor)

                        <option value="{{ $instructor->id }}" {{ $seguimiento->instructor_id == $instructor->id ? 'selected' : '' }}>

                            {{ $instructor->nombre_completo }}

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

                        <option value="{{ $estado->id }}" {{ $seguimiento->estado_id == $estado->id ? 'selected' : '' }}>

                            {{ $estado->nombre_estado }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- NUMERO -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Número Seguimiento

                    </label>

                    <select
                        name="numero_seguimiento"
                        class="form-select"
                        required>
                        <option value="1" {{ $seguimiento->numero_seguimiento == 1 ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $seguimiento->numero_seguimiento == 2 ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $seguimiento->numero_seguimiento == 3 ? 'selected' : '' }}>3</option>
                    </select>

                </div>

                <!-- FECHA -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Fecha Programada

                    </label>

                    <input
                        type="date"
                        name="fecha_programada"
                        class="form-control"
                        value="{{ $seguimiento->fecha_programada }}"
                        required>

                </div>

            </div>

            <!-- FECHA REALIZADA -->

            <div class="mb-3">

                <label class="form-label">

                    Fecha Realizada

                </label>

                <input
                    type="date"
                    name="fecha_realizada"
                    class="form-control"
                    value="{{ $seguimiento->fecha_realizada }}">

            </div>

            <!-- OBSERVACIONES -->

            <div class="mb-3">

                <label class="form-label">

                    Observaciones

                </label>

                <textarea
                    name="observaciones"
                    rows="4"
                    class="form-control">{{ $seguimiento->observaciones }}</textarea>

            </div>

            <!-- COMPROMISOS -->

            <div class="mb-3">

                <label class="form-label">

                    Compromisos

                </label>

                <textarea
                    name="compromisos"
                    rows="4"
                    class="form-control">{{ $seguimiento->compromisos }}</textarea>

            </div>

            <!-- RECOMENDACIONES -->

            <div class="mb-3">

                <label class="form-label">

                    Recomendaciones

                </label>

                <textarea
                    name="recomendaciones"
                    rows="4"
                    class="form-control">{{ $seguimiento->recomendaciones }}</textarea>
            </div>

            <button
                class="btn btn-primary">

                Guardar

            </button>

            <a href="{{ route('seguimientos.index') }}"
               class="btn btn-secondary">

                Volver

            </a>

        </form>

    </div>

</div>

@stop