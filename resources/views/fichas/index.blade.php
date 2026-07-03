@extends('adminlte::page')

@section('title', 'Fichas')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Fichas</h1>

    <a href="{{ route('fichas.create') }}"
       class="btn btn-primary">

        Nueva Ficha

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

                    <th>Ficha</th>

                    <th>Programa</th>

                    <th width="180">Acciones</th>

                </tr>

            </thead>

            <tbody>

                @forelse($fichas as $ficha)

                <tr>

                    <td>{{ $ficha->id }}</td>

                    <td>{{ $ficha->numero_ficha }}</td>

                    <td>
                        {{ $ficha->programa->nombre_programa }}
                    </td>

                    <td>

                        <a href="{{ route('fichas.edit', $ficha) }}"
                           class="btn btn-warning btn-sm">

                            Editar

                        </a>

                        <form
                            action="{{ route('fichas.destroy', $ficha) }}"
                            method="POST"
                            class="d-inline"
                            onclick="return confirm('¿Seguro de eliminar este registro?')">

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

                    <td colspan="4">

                        No hay fichas registradas

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $fichas->links() }}

        </div>

    </div>

</div>

@stop