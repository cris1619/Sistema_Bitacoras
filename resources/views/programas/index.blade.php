@extends('adminlte::page')

@section('title', 'Programas')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Programas de Formación</h1>

    <a href="{{ route('programas.create') }}"
       class="btn btn-primary">

        Nuevo Programa

    </a>

</div>

@stop

@section('content')

@include('partials.alerts')

<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Código</th>

                    <th>Programa</th>

                    <th>Nivel</th>

                    <th width="180">

                        Acciones

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($programas as $programa)

                <tr>

                    <td>

                        {{ $programa->id }}

                    </td>

                    <td>

                        {{ $programa->codigo_programa }}

                    </td>

                    <td>

                        {{ $programa->nombre_programa }}

                    </td>

                    <td>

                        {{ $programa->nivel_formacion }}

                    </td>

                    <td>

                        <a href="{{ route('programas.edit', $programa) }}"
                           class="btn btn-warning btn-sm">

                            Editar

                        </a>

                        <button
                            type="button"
                            class="btn btn-danger btn-sm"

                            data-toggle="modal"
                            data-target="#modalEliminar{{ $programa->id }}">

                            Eliminar

                        </button>

                        @include(
                            'partials.modal-delete',

                            [

                                'modalId' =>
                                    'modalEliminar' . $programa->id,

                                'route' =>
                                    route(
                                        'programas.destroy',
                                        $programa
                                    ),

                                'message' =>
                                    '¿Seguro que deseas eliminar este programa?'

                            ]
                        )

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">

                        No hay programas registrados

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $programas->links() }}

        </div>

    </div>

</div>

@stop