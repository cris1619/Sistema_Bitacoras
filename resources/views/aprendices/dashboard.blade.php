@extends('adminlte::page')

@section('title', 'Dashboard Aprendiz')

@section('content_header')

<h1>

    Dashboard —
    {{ $aprendice->nombres }}
    {{ $aprendice->apellidos }}

</h1>

@stop

@section('content')
<div class="row mb-4">

    <!-- TOTAL -->

    <div class="col-md-3">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>

                    {{ $totalBitacoras }}

                </h3>

                <p>

                    Total Bitácoras

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-book"></i>

            </div>

        </div>

    </div>

    <!-- ENTREGADAS -->

    <div class="col-md-3">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>

                    {{ $entregadas }}

                </h3>

                <p>

                    Entregadas

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-check"></i>

            </div>

        </div>

    </div>

    <!-- PENDIENTES -->

    <div class="col-md-3">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>

                    {{ $pendientes }}

                </h3>

                <p>

                    Pendientes

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-clock"></i>

            </div>

        </div>

    </div>

    <!-- VENCIDAS -->

    <div class="col-md-3">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>

                    {{ $vencidas }}

                </h3>

                <p>

                    Vencidas

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-exclamation"></i>

            </div>

        </div>

    </div>

</div>
<div class="row">

    <!-- INFORMACIÓN -->

    <div class="col-md-4">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    Información General

                </h3>

            </div>

            <div class="card-body">

                <p>

                    <strong>Documento:</strong>

                    {{ $aprendice->documento_identidad }}

                </p>

                <p>

                    <strong>Correo:</strong>

                    {{ $aprendice->correo_electronico }}

                </p>

                <p>

                    <strong>Teléfono:</strong>

                    {{ $aprendice->telefono }}

                </p>

                <p>

                    <strong>Empresa:</strong>

                    {{ $aprendice->empresa }}

                </p>

                <p>

                    <strong>Inicio:</strong>

                    {{ $aprendice->fecha_inicio_practica }}

                </p>

                <p>

                    <strong>Fin:</strong>

                    {{ $aprendice->fecha_fin_practica }}

                </p>

            </div>

        </div>

    </div>

    <!-- BITÁCORAS -->

    <div class="col-md-8">

        <div class="card card-success">

            <div class="card-header">

                <h3 class="card-title">

                    Bitácoras

                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    @foreach($bitacoras as $bitacora)

                    <div class="col-md-3 mb-3">

                        <div class="border rounded p-2

                            @if($bitacora->estado->nombre_estado == 'Entregada')

                                bg-success text-white

                            @elseif($bitacora->fecha_limite_entrega < now())

                                bg-danger text-white

                            @else

                                bg-warning

                            @endif
                            ">

                            <h5>

                                Bitácora
                                {{ $bitacora->numero_bitacora }}

                            </h5>

                            <p>

                                {{ $bitacora->estado->nombre_estado }}

                            </p>

                            <small>

                                {{ $bitacora->fecha_limite_entrega }}

                            </small>

                            <br><br>

                            <a href="{{ route('bitacoras.show', $bitacora) }}"
                               class="btn btn-info btn-sm">

                                Ver

                            </a>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

            <div class="card mb-4">

    <div class="card-body">

        <h4>

            Progreso General

        </h4>

        <div class="progress">

            <div
                class="progress-bar"
                role="progressbar"

                style="width: {{ $progreso }}%">

                {{ $progreso }}%

            </div>

        </div>

    </div>

</div>

        </div>

    </div>

</div>

<!-- SEGUIMIENTOS -->

<div class="card card-warning">

    <div class="card-header">

        <h3 class="card-title">

            Seguimientos

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Fecha</th>
                    <th>Estado</th>

                </tr>

            </thead>

            <tbody>

                @foreach($seguimientos as $seguimiento)

                <tr>

                    <td>

                        {{ $seguimiento->numero_seguimiento }}

                    </td>

                    <td>

                        {{ $seguimiento->fecha_programada }}

                    </td>

                    <td>

                        {{ $seguimiento->estado->nombre_estado }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop