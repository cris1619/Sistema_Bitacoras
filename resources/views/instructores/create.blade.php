@extends('adminlte::page')

@section('title', 'Registrar Instructor')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>
        <i class="fas fa-user-plus text-success"></i>
        Registrar Instructor
    </h1>

    <a href="{{ route('instructores.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Volver
    </a>

</div>

@stop

@section('content')

@if ($errors->any())

<div class="alert alert-danger">

    <h5>

        <i class="fas fa-ban"></i>

        Se encontraron los siguientes errores

    </h5>

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('instructores.store') }}" method="POST">

    @csrf

    <div class="card card-outline card-primary">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-id-card"></i>

                Información Personal

            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Tipo de documento</label>

                        <select
                            name="tipo_documento"
                            class="form-control @error('tipo_documento') is-invalid @enderror"
                            required>

                            <option value="">Seleccione</option>

                            <option value="CC" {{ old('tipo_documento')=='CC'?'selected':'' }}>
                                Cédula
                            </option>

                            <option value="TI" {{ old('tipo_documento')=='TI'?'selected':'' }}>
                                Tarjeta de Identidad
                            </option>

                            <option value="CE" {{ old('tipo_documento')=='CE'?'selected':'' }}>
                                Cédula de Extranjería
                            </option>

                        </select>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Documento</label>

                        <input
                            type="text"
                            name="documento_identidad"
                            class="form-control @error('documento_identidad') is-invalid @enderror"
                            value="{{ old('documento_identidad') }}"
                            maxlength="20"
                            placeholder="Número de documento">

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Nombres</label>

                        <input
                            type="text"
                            name="nombres"
                            class="form-control @error('nombres') is-invalid @enderror"
                            value="{{ old('nombres') }}"
                            maxlength="100"
                            placeholder="Ingrese los nombres">

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Apellidos</label>

                        <input
                            type="text"
                            name="apellidos"
                            class="form-control @error('apellidos') is-invalid @enderror"
                            value="{{ old('apellidos') }}"
                            maxlength="100"
                            placeholder="Ingrese los apellidos">

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card card-outline card-success">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-address-book"></i>

                Información de Contacto

            </h3>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Correo electrónico</label>

                        <input
                            type="email"
                            name="correo_electronico"
                            class="form-control @error('correo_electronico') is-invalid @enderror"
                            value="{{ old('correo_electronico') }}"
                            placeholder="correo@sena.edu.co">

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Teléfono</label>

                        <input
                            type="text"
                            name="telefono"
                            class="form-control @error('telefono') is-invalid @enderror"
                            value="{{ old('telefono') }}"
                            maxlength="20"
                            placeholder="Número de teléfono">

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="card card-outline card-warning">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-graduation-cap"></i>

                Programas de Formación

            </h3>

        </div>

        <div class="card-body">

            <div class="form-group">

                <label>Seleccione uno o varios programas</label>

                <select
                    name="programas[]"
                    class="form-control @error('programas') is-invalid @enderror"
                    multiple
                    size="8"
                    required>

                    @foreach($programas as $programa)

                        <option
                            value="{{ $programa->id }}"
                            @selected(collect(old('programas'))->contains($programa->id))>

                            {{ $programa->nombre_programa }}

                        </option>

                    @endforeach

                </select>

                <small class="text-muted">

                    Mantenga presionada la tecla <strong>Ctrl</strong> para seleccionar varios programas.

                </small>

            </div>

        </div>

    </div>

    <div class="card">

        <div class="card-body text-right">

            <a href="{{ route('instructores.index') }}"
               class="btn btn-secondary">

                <i class="fas fa-times"></i>

                Cancelar

            </a>

            <button
                type="submit"
                class="btn btn-success">

                <i class="fas fa-save"></i>

                Registrar Instructor

            </button>

        </div>

    </div>

</form>

@stop