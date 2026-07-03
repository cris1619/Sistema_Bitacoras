@extends('adminlte::page')

@section('title', 'Bitácoras')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Bitácoras</h1>

    <a href="{{ route('bitacoras.create') }}"
       class="btn btn-primary">

        Nueva Bitácora

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

                    <th>Estado</th>

                    <th>Entrega</th>

                    <th width="220">

                        Acciones

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($bitacoras as $bitacora)

                <tr>

                    <td>

                        {{ $bitacora->numero_bitacora }}

                    </td>

                    <td>

                        {{ $bitacora->aprendiz->nombres }}
                        {{ $bitacora->aprendiz->apellidos }}

                    </td>

                    <td>

                        {{ $bitacora->estado->nombre_estado }}

                    </td>

                    <td>

                        {{ $bitacora->fecha_limite_entrega }}

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

                        <form
                            action="{{ route('bitacoras.destroy', $bitacora) }}"
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

                    <td colspan="5">

                        No hay bitácoras registradas

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $bitacoras->links() }}

        </div>

    </div>

</div>

@stop