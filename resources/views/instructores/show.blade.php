@extends('adminlte::page')

@section('title', 'Detalle del Instructor')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-user-circle text-primary"></i>
        Detalle del Instructor
    </h1>

    <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Volver
    </a>

</div>

@stop

@section('content')

<div class="row">

    <div class="col-md-4">

        <div class="card card-primary card-outline">

            <div class="card-body text-center">

                <i class="fas fa-user-tie fa-6x text-primary mb-3"></i>

                <h3 class="mb-0">

                    {{ $instructor->nombres }}
                    {{ $instructor->apellidos }}

                </h3>

                <p class="text-muted">

                    Instructor

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-8">

        <div class="card card-outline card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-id-card"></i>

                    Información General

                </h3>

            </div>

            <div class="card-body">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <strong>

                            <i class="fas fa-address-card text-primary"></i>
                            Tipo Documento

                        </strong>

                    </div>

                    <div class="col-md-8">

                        {{ $instructor->tipo_documento }}

                    </div>

                </div>

                <hr>

                <div class="row mb-3">

                    <div class="col-md-4">

                        <strong>

                            <i class="fas fa-id-badge text-primary"></i>
                            Documento

                        </strong>

                    </div>

                    <div class="col-md-8">

                        {{ $instructor->documento_identidad }}

                    </div>

                </div>

                <hr>

                <div class="row mb-3">

                    <div class="col-md-4">

                        <strong>

                            <i class="fas fa-envelope text-primary"></i>
                            Correo

                        </strong>

                    </div>

                    <div class="col-md-8">

                        {{ $instructor->correo_electronico }}

                    </div>

                </div>

                <hr>

                <div class="row mb-3">

                    <div class="col-md-4">

                        <strong>

                            <i class="fas fa-phone text-primary"></i>
                            Teléfono

                        </strong>

                    </div>

                    <div class="col-md-8">

                        {{ $instructor->telefono }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card card-outline card-success">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-graduation-cap"></i>

            Programas de Formación Asignados

        </h3>

    </div>

    <div class="card-body">

        @forelse($instructor->programas as $programa)

            <span class="badge badge-primary p-2 mr-2 mb-2">

                <i class="fas fa-book"></i>

                {{ $programa->nombre_programa }}

            </span>

        @empty

            <div class="alert alert-warning mb-0">

                <i class="fas fa-exclamation-circle"></i>

                Este instructor no tiene programas asignados.

            </div>

        @endforelse

    </div>

</div>

<div class="text-right">

    <a href="{{ route('instructores.index') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Regresar

    </a>

</div>

@stop