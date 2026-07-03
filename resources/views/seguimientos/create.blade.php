@extends('adminlte::page')

@section('title', 'Nuevo Seguimiento')

@section('content_header')

<h1>Nuevo Seguimiento</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('seguimientos.store') }}"
            method="POST">

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

                        <option value="{{ $instructor->id }}">

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

                        <option value="{{ $estado->id }}">

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
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
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
                    class="form-control">

            </div>

            <!-- OBSERVACIONES -->

            <div class="mb-3">

                <label class="form-label">

                    Observaciones

                </label>

                <textarea
                    name="observaciones"
                    rows="4"
                    class="form-control"></textarea>

            </div>

            <!-- COMPROMISOS -->

            <div class="mb-3">

                <label class="form-label">

                    Compromisos

                </label>

                <textarea
                    name="compromisos"
                    rows="4"
                    class="form-control"></textarea>

            </div>

            <!-- RECOMENDACIONES -->

            <div class="mb-3">

                <label class="form-label">

                    Recomendaciones

                </label>

                <textarea
                    name="recomendaciones"
                    rows="4"
                    class="form-control"></textarea>

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