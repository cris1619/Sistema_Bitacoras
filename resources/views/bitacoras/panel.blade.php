@extends('adminlte::page')

@section('title', 'Bitácoras Aprendiz')

@section('content_header')

<h1>

    Bitácoras —
    {{ $aprendice->nombres }}
    {{ $aprendice->apellidos }}

</h1>

@stop

@section('content')

<div class="row">

@for($i = 1; $i <= 12; $i++)

    @php

        $bitacora = $bitacoras->firstWhere(
            'numero_bitacora',
            $i
        );

    @endphp

    <div class="col-md-3">

        <div class="card">

            <div class="card-header bg-primary">

                <h3 class="card-title">

                    Bitácora {{ $i }}

                </h3>

            </div>

            <div class="card-body">

                @if($bitacora)

                    <p>

                        <strong>Estado:</strong>

                        {{ $bitacora->estado->nombre_estado }}

                    </p>

                    <p>

                        <strong>Entrega:</strong>

                        {{ $bitacora->fecha_limite_entrega }}

                    </p>

                    <a href="{{ route('bitacoras.show', $bitacora) }}"
                       class="btn btn-info btn-sm">

                        Ver

                    </a>

                    <a href="{{ route('bitacoras.edit', $bitacora) }}"
                       class="btn btn-warning btn-sm">

                        Editar

                    </a>

                @else

                    <p>

                        No registrada

                    </p>

                    <a href="{{ route('bitacoras.create') }}?aprendiz={{ $aprendice->id }}&numero={{ $i }}"
                       class="btn btn-success btn-sm">

                        Crear

                    </a>

                @endif

            </div>

        </div>

    </div>

@endfor

</div>

<a href="{{ route('aprendices.index') }}"
   class="btn btn-secondary">

    Volver

</a>

@stop