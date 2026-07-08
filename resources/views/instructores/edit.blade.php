@extends('adminlte::page')

@section('title', 'Editar Instructor')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>
        <i class="fas fa-user-edit text-primary"></i>
        Editar Instructor
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
        <i class="icon fas fa-ban"></i>
        Se encontraron errores
    </h5>

    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

</div>
@endif

<form action="{{ route('instructores.update',$instructor->id) }}" method="POST">

    @csrf
    @method('PUT')

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

                            <option value="CC"
                                {{ old('tipo_documento',$instructor->tipo_documento)=='CC'?'selected':'' }}>
                                Cédula
                            </option>

                            <option value="TI"
                                {{ old('tipo_documento',$instructor->tipo_documento)=='TI'?'selected':'' }}>
                                Tarjeta de Identidad
                            </option>

                            <option value="CE"
                                {{ old('tipo_documento',$instructor->tipo_documento)=='CE'?'selected':'' }}>
                                Cédula de Extranjería
                            </option>

                        </select>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Número de documento</label>

                        <input
                            type="text"
                            name="documento_identidad"
                            class="form-control @error('documento_identidad') is-invalid @enderror"
                            value="{{ old('documento_identidad',$instructor->documento_identidad) }}"
                            maxlength="20"
                            placeholder="Ingrese el documento">

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                        <label>Nombres</label>

                        <input
                            type="text"
                            name="nombres"
                            class="form-control @error('nombres') is-invalid @enderror"
                            value="{{ old('nombres',$instructor->nombres) }}"
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
                            value="{{ old('apellidos',$instructor->apellidos) }}"
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
                            value="{{ old('correo_electronico',$instructor->correo_electronico) }}"
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
                            value="{{ old('telefono',$instructor->telefono) }}"
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

                Programas Asignados

            </h3>

        </div>

        <div class="card-body">

            <div class="form-group">

                <label>Seleccione uno o varios programas</label>

                <select
                    name="programas[]"
                    class="form-control"
                    multiple
                    size="8">

                    @foreach($programas as $programa)

                        <option
                            value="{{ $programa->id }}"
                            @selected(
                                collect(old('programas',$instructor->programas->pluck('id')))
                                ->contains($programa->id)
                            )>

                            {{ $programa->nombre_programa }}

                        </option>

                    @endforeach

                </select>

                <small class="text-muted">

                    Mantenga presionada la tecla <b>Ctrl</b> para seleccionar varios programas.

                </small>

            </div>

        </div>

    </div>



    <div class="card">

        <div class="card-body text-right">

            <a
                href="{{ route('instructores.index') }}"
                class="btn btn-secondary">

                <i class="fas fa-times"></i>

                Cancelar

            </a>

            <button
                type="submit"
                class="btn btn-success">

                <i class="fas fa-save"></i>

                Actualizar Instructor

            </button>

        </div>

    </div>

</form>

@stop