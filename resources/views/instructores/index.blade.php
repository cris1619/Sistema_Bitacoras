@extends('adminlte::page')

@section('title', 'Instructores')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>

        <i class="fas fa-chalkboard-teacher text-primary"></i>

        Gestión de Instructores

    </h1>

    <a
        href="{{ route('instructores.create') }}"
        class="btn btn-success">

        <i class="fas fa-user-plus"></i>

        Nuevo Instructor

    </a>

</div>

@stop

@section('content')

@include('partials.alerts')

<div class="card card-outline card-primary">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-list"></i>

            Listado de Instructores

        </h3>

        <div class="card-tools">

            <span class="badge badge-primary">

                Total: {{ $instructores->total() }}

            </span>

        </div>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover table-bordered align-middle mb-0">

            <thead class="thead-dark">

                <tr class="text-center">

                    <th width="140">

                        Documento

                    </th>

                    <th>

                        Instructor

                    </th>

                    <th>

                        Correo Electrónico

                    </th>

                    <th>

                        Programas

                    </th>

                    <th width="180">

                        Acciones

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($instructores as $instructor)

                    <tr>

                        <td class="text-center">

                            {{ $instructor->documento_identidad }}

                        </td>

                        <td>

                            <strong>

                                {{ $instructor->nombre_completo }}

                            </strong>

                        </td>

                        <td>

                            <i class="fas fa-envelope text-primary"></i>

                            {{ $instructor->correo_electronico }}

                        </td>

                        <td>

                            @forelse($instructor->programas as $programa)

                                <span class="badge badge-info mr-1 mb-1">

                                    <i class="fas fa-book"></i>

                                    {{ $programa->nombre_programa }}

                                </span>

                            @empty

                                <span class="badge badge-secondary">

                                    Sin programas

                                </span>

                            @endforelse

                        </td>

                        <td class="text-center">

                            <a
                                href="{{ route('instructores.show', $instructor) }}"
                                class="btn btn-info btn-sm"
                                title="Ver">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a
                                href="{{ route('instructores.edit', $instructor) }}"
                                class="btn btn-warning btn-sm"
                                title="Editar">

                                <i class="fas fa-edit"></i>

                            </a>

                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                title="Eliminar"
                                data-toggle="modal"
                                data-target="#modalEliminar{{ $instructor->id }}">

                                <i class="fas fa-trash"></i>

                            </button>

                            @include(
                                'partials.modal-delete',
                                [
                                    'modalId' => 'modalEliminar'.$instructor->id,

                                    'route' => route(
                                        'instructores.destroy',
                                        $instructor
                                    ),

                                    'message' => '¿Está seguro de eliminar este instructor?'
                                ]
                            )

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            <div class="text-center py-5">

                                <i class="fas fa-user-slash fa-3x text-secondary mb-3"></i>

                                <h5>

                                    No hay instructores registrados.

                                </h5>

                                <a
                                    href="{{ route('instructores.create') }}"
                                    class="btn btn-success mt-2">

                                    <i class="fas fa-plus"></i>

                                    Registrar Instructor

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($instructores->hasPages())

        <div class="card-footer clearfix">

            <div class="float-right">

                {{ $instructores->links() }}

            </div>

        </div>

    @endif

</div>

@stop