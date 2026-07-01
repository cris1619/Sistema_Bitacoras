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

                    <th>ID</th>

                    <th>Código</th>

                    <th>Programa</th>

                    <th>Nivel</th>

                    <th width="180">Acciones</th>

                </tr>

            </thead>

            <tbody>

                @forelse($programas as $programa)

                    <tr>

                        <td>{{ $programa->id }}</td>

                        <td>{{ $programa->codigo_programa }}</td>

                        <td>{{ $programa->nombre_programa }}</td>

                        <td>{{ $programa->nivel_formacion }}</td>

                        <td>

                            <a href="{{ route('programas.edit', $programa) }}"
                               class="btn btn-warning btn-sm">

                                Editar

                            </a>

                            <form
                                action="{{ route('programas.destroy', $programa) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm">

                                    Eliminar

                                </button>

                            </form>

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