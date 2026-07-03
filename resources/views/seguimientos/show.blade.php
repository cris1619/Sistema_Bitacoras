@extends('adminlte::page')

@section('title', 'Detalle Seguimiento')

@section('content_header')

<h1>Detalle Seguimiento</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <p>

            <strong>Aprendiz:</strong>

            {{ $seguimiento->aprendiz->nombres }}
            {{ $seguimiento->aprendiz->apellidos }}

        </p>

        <p>

            <strong>Instructor:</strong>

            {{ $seguimiento->instructor->nombre_completo }}

        </p>

        <p>

            <strong>Estado:</strong>

            {{ $seguimiento->estado->nombre_estado }}

        </p>

        <p>

            <strong>Número:</strong>

            {{ $seguimiento->numero_seguimiento }}

        </p>

        <p>

            <strong>Fecha Programada:</strong>

            {{ $seguimiento->fecha_programada }}

        </p>

        <p>

            <strong>Fecha Realizada:</strong>

            {{ $seguimiento->fecha_realizada }}

        </p>

        <hr>

        <h5>Observaciones</h5>

        <p>

            {{ $seguimiento->observaciones }}

        </p>

        <h5>Compromisos</h5>

        <p>

            {{ $seguimiento->compromisos }}

        </p>

        <h5>Recomendaciones</h5>

        <p>

            {{ $seguimiento->recomendaciones }}

        </p>

        <a href="{{ route('seguimientos.index') }}"
           class="btn btn-secondary">

            Volver

        </a>

    </div>

</div>

@stop