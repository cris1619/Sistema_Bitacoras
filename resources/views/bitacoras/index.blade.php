@extends('adminlte::page')

@section('title', 'Bitácoras')

@section('content_header')

<h1>

    Gestión de Bitácoras

</h1>

@stop

@section('content')

@include('partials.alerts')

<div class="card">

    <div class="card-body">

        <input
            type="text"
            id="buscadorAprendiz"
            class="form-control"

            placeholder="Buscar aprendiz por nombre, apellido o documento">

    </div>

</div>

<div class="accordion" id="accordionBitacoras">

@foreach($aprendices as $aprendiz)

<div class="card aprendiz-card">

    <div
        class="card-header"

        data-search="
        {{ strtolower($aprendiz->nombres) }}
        {{ strtolower($aprendiz->apellidos) }}
        {{ strtolower($aprendiz->documento_identidad) }}
        ">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <strong>

                    {{ $aprendiz->nombres }}
                    {{ $aprendiz->apellidos }}

                </strong>

                <br>

                <small>

                    Documento:
                    {{ $aprendiz->documento_identidad }}

                    |

                    Ficha:
                    {{ $aprendiz->ficha->numero_ficha }}

                    -

                    {{ $aprendiz->ficha->programa->nombre_programa }}

                </small>

            </div>

            <button
                class="btn btn-primary"

                type="button"

                data-toggle="collapse"

                data-target="#collapse{{ $aprendiz->id }}">

                Ver Bitácoras

            </button>

        </div>

    </div>

    <div
        id="collapse{{ $aprendiz->id }}"
        class="collapse"

        data-parent="#accordionBitacoras">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>#</th>

                        <th>Estado</th>

                        <th>Fecha límite</th>

                        <th>Archivo</th>

                        <th width="180">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($aprendiz->bitacoras as $bitacora)

                    <tr>

                        <td>

                            Bitácora
                            {{ $bitacora->numero_bitacora }}

                        </td>

                        <td>

                            {{ $bitacora->estado->nombre_estado }}

                        </td>

                        <td>

                            {{ $bitacora->fecha_limite_entrega }}

                        </td>

                        <td>

                            @if($bitacora->archivo_evidencia_url)

                            <a href="{{ asset('storage/' . $bitacora->archivo_evidencia_url) }}"
                               target="_blank">

                                Ver archivo

                            </a>

                            @else

                            <span class="text-muted">

                                Sin archivo

                            </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('bitacoras.show', $bitacora) }}"
                               class="btn btn-info btn-sm">

                                Ver

                            </a>

                            <a href="{{ route('bitacoras.edit', $bitacora) }}"
                               class="btn btn-warning btn-sm">

                                Editar

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endforeach

</div>

<div class="mt-3">

    {{ $aprendices->links() }}

</div>

@stop

@section('js')

<script>

document.addEventListener(

    'DOMContentLoaded',

    function () {

        const buscador = document.getElementById(
            'buscadorAprendiz'
        );

        buscador.addEventListener(

            'keyup',

            function () {

                let valor =
                    this.value.toLowerCase();

                let cards =
                    document.querySelectorAll(
                        '.aprendiz-card'
                    );

                cards.forEach(card => {

                    let texto =
                        card.querySelector(
                            '.card-header'
                        )
                        .dataset
                        .search;

                    if (
                        texto.includes(valor)
                    ) {

                        card.style.display =
                            '';

                    } else {

                        card.style.display =
                            'none';
                    }
                });
            }
        );
    }
);

</script>

@stop