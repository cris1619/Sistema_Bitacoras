@extends('adminlte::page')

@section('title', 'Aprendices')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Aprendices</h1>

    <a href="{{ route('aprendices.create') }}"
       class="btn btn-primary">

        Nuevo Aprendiz

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

                    <th>Documento</th>

                    <th>Nombre</th>

                    <th>Ficha</th>

                    <th>Programa</th>

                    <th>Estado</th>

                    <th width="180">Acciones</th>

                </tr>

            </thead>

            <tbody>

                @forelse($aprendices as $aprendiz)

                <tr>

                    <td>
                        {{ $aprendiz->documento_identidad }}
                    </td>

                    <td>
                        {{ $aprendiz->nombres }}
                        {{ $aprendiz->apellidos }}
                    </td>

                    <td>
                        {{ $aprendiz->ficha->numero_ficha }}
                    </td>

                    <td>
                        {{ $aprendiz->ficha->programa->nombre_programa }}
                    </td>

                    <td>
                        {{ $aprendiz->estado->nombre_estado }}
                    </td>

                    <td>
                        <a href="{{ route('aprendices.show', $aprendiz) }}"
                            class="btn btn-info btn-sm">

                            Ver

                        </a>

                        <a href="{{ route('aprendices.edit', $aprendiz) }}"
                           class="btn btn-warning btn-sm">

                            Editar

                        </a>

                        <form
                            action="{{ route('aprendices.destroy', $aprendiz) }}"
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

                        No hay aprendices registrados

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $aprendices->links() }}

        </div>

    </div>

</div>

@stop