@extends('adminlte::page')

@section('title', 'Detalle Bitácora')

@section('content_header')

<h1>Detalle Bitácora</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <!-- APRENDIZ -->

        <p>

            <strong>Aprendiz:</strong>

            {{ $bitacora->aprendiz->nombres }}
            {{ $bitacora->aprendiz->apellidos }}

        </p>

        <!-- SEGUIMIENTO -->

        <p>

            <strong>Seguimiento:</strong>

            @if($bitacora->seguimiento)

                Seguimiento
                {{ $bitacora->seguimiento->numero_seguimiento }}

            @else

                No asociado

            @endif

        </p>

        <!-- ESTADO -->

        <p>

            <strong>Estado:</strong>

            {{ $bitacora->estado->nombre_estado }}

        </p>

        <!-- NUMERO -->

        <p>

            <strong>Número Bitácora:</strong>

            {{ $bitacora->numero_bitacora }}

        </p>

        <!-- FECHA LIMITE -->

        <p>

            <strong>Fecha Límite:</strong>

            {{ $bitacora->fecha_limite_entrega }}

        </p>

        <!-- FECHA ENTREGA -->

        <p>

            <strong>Fecha Entrega:</strong>

            {{ $bitacora->fecha_entrega }}

        </p>

        <hr>

        <!-- EVIDENCIA -->

        <h5>Evidencia</h5>

        @if($bitacora->archivo_evidencia_url)

            <a href="{{ asset('storage/' . $bitacora->archivo_evidencia_url) }}"
               target="_blank"
               class="btn btn-primary">

                Ver Evidencia

            </a>

        @else

            <p>No hay evidencia cargada</p>

        @endif

        <hr>

        <!-- NOVEDADES -->

        <h5>Novedades</h5>

        <p>

            {{ $bitacora->novedades }}

        </p>

        <a href="{{ route('bitacoras.index') }}"
           class="btn btn-secondary mt-3">

            Volver

        </a>

    </div>

</div>

@stop