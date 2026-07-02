@extends('adminlte::page')

@section('title', 'Detalle Aprendiz')

@section('content_header')

    <h1>Detalle Aprendiz</h1>

@stop

@section('content')

<div class="card">

    <div class="card-header bg-primary">

        <h3 class="card-title">

            Información General

        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <p>

                    <strong>Documento:</strong>

                    {{ $aprendice->tipo_documento }}
                    -
                    {{ $aprendice->documento_identidad }}

                </p>

                <p>

                    <strong>Nombre:</strong>

                    {{ $aprendice->nombres }}
                    {{ $aprendice->apellidos }}

                </p>

                <p>

                    <strong>Correo:</strong>

                    {{ $aprendice->correo_electronico }}

                </p>

                <p>

                    <strong>Teléfono:</strong>

                    {{ $aprendice->telefono }}

                </p>

            </div>

            <div class="col-md-6">

                <p>

                    <strong>Ficha:</strong>

                    {{ $aprendice->ficha->numero_ficha }}

                </p>

                <p>

                    <strong>Programa:</strong>

                    {{ $aprendice->ficha->programa->nombre_programa }}

                </p>

                <p>

                    <strong>Estado:</strong>

                    {{ $aprendice->estado->nombre_estado }}

                </p>

                <p>

                    <strong>Vínculo:</strong>

                    {{ $aprendice->vinculo->nombre_vinculo }}

                </p>

            </div>

        </div>

    </div>

</div>

<!-- EMPRESA -->

<div class="card">

    <div class="card-header bg-success">

        <h3 class="card-title">

            Información Empresa

        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <p>

                    <strong>Empresa:</strong>

                    {{ $aprendice->empresa ?? 'No registrada' }}

                </p>

                <p>

                    <strong>Jefe Inmediato:</strong>

                    {{ $aprendice->jefe_inmediato ?? 'No registrado' }}

                </p>

            </div>

            <div class="col-md-6">

                <p>

                    <strong>Correo Empresa:</strong>

                    {{ $aprendice->correo_empresa ?? 'No registrado' }}

                </p>

                <p>

                    <strong>Teléfono Empresa:</strong>

                    {{ $aprendice->telefono_empresa ?? 'No registrado' }}

                </p>

            </div>

        </div>

    </div>

</div>

<!-- ETAPA PRODUCTIVA -->

<div class="card">

    <div class="card-header bg-warning">

        <h3 class="card-title">

            Etapa Productiva

        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <p>

                    <strong>Fecha Inicio:</strong>

                    {{ $aprendice->fecha_inicio_practica }}

                </p>

            </div>

            <div class="col-md-6">

                <p>

                    <strong>Fecha Fin:</strong>

                    {{ $aprendice->fecha_fin_practica }}

                </p>

            </div>

        </div>

        <hr>

        <p>

            <strong>Detalles Contrato:</strong>

        </p>

        <p>

            {{ $aprendice->detalles_contrato ?? 'Sin detalles registrados' }}

        </p>

    </div>

</div>

<a href="{{ route('aprendices.index') }}"
   class="btn btn-secondary">

    Volver

</a>

@stop