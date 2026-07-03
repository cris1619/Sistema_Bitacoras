@extends('adminlte::page')

@section('title', 'Seguimientos')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Seguimientos</h1>

    <a href="{{ route('seguimientos.create') }}"
       class="btn btn-primary">

        Nuevo Seguimiento

    </a>

</div>

@stop

@section('content')

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>#</th>

                    <th>Aprendiz</th>

                    <th>Instructor</th>

                    <th>Estado</th>

                    <th>Fecha</th>

                    <th width="200">

                        Acciones

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($seguimientos as $seguimiento)

                <tr>

                    <td>
                        {{ $seguimiento->numero_seguimiento }}
                    </td>

                    <td>
                        {{ $seguimiento->aprendiz->nombres }}
                        {{ $seguimiento->aprendiz->apellidos }}
                    </td>

                    <td>
                        {{ $seguimiento->instructor->nombre_completo }}
                    </td>

                    <td>
                        {{ $seguimiento->estado->nombre_estado }}
                    </td>

                    <td>
                        {{ $seguimiento->fecha_programada }}
                    </td>

                    <td>

                        <a href="{{ route('seguimientos.show', $seguimiento) }}"
                            class="btn btn-info btn-sm">

                            Ver

                        </a>

                        <a href="{{ route('seguimientos.edit', $seguimiento) }}"
                           class="btn btn-warning btn-sm">

                            Editar

                        </a>

                        <form
                            action="{{ route('seguimientos.destroy', $seguimiento) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm">

                                Eliminar

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6">

                        No hay seguimientos registrados

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $seguimientos->links() }}

        </div>

    </div>

</div>

@stop