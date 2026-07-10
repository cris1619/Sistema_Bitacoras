@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')

<h1>

    Editar Usuario

</h1>

@stop

@section('content')

@include('partials.alerts')

<form
    action="{{ route('usuarios.update', $usuario) }}"
    method="POST">

    @csrf

    @method('PUT')

    <div class="row">

        <div class="card">

    <div class="card-header bg-primary">

        <h3 class="card-title">

            Información General

        </h3>

    </div>

    <div class="card-body">

        <div class="form-group">

            <label>

                Nombre Completo

            </label>

            <input
                type="text"
                name="nombre_completo"
                class="form-control"

                value="{{ old('nombre_completo', $usuario->nombre_completo) }}">

        </div>

        <div class="form-group">

            <label>

                Correo Electrónico

            </label>

            <input
                type="email"
                name="email"
                class="form-control"

                value="{{ old('email', $usuario->email) }}">

        </div>

    </div>

</div>

        <div class="card">

    <div class="card-header bg-warning">

        <h3 class="card-title">

            Seguridad

        </h3>

    </div>

    <div class="card-body">

        <div class="form-group">

            <label>

                Nueva contraseña

            </label>

            <input
                type="password"
                name="password"
                class="form-control">

            <small class="text-muted">

                Déjelo vacío si no desea cambiarla.

            </small>

        </div>

        <div class="form-group">

            <label>

                Confirmar contraseña

            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control">

        </div>

    </div>

</div>

    </div>

    <div class="row mt-3">

        <div class="card">

    <div class="card-header bg-success">

        <h3 class="card-title">

            Rol del Usuario

        </h3>

    </div>

    <div class="card-body">

        @php

            $rolActual = $usuario->roles->first()?->id;

        @endphp

        @foreach($roles as $rol)

            @php

                switch($rol->nombre_rol){

                    case 'Administrador':
                        $color='danger';
                        $icon='fas fa-user-shield';
                        break;

                    case 'Coordinador':
                        $color='primary';
                        $icon='fas fa-user-tie';
                        break;

                    case 'Instructor':
                        $color='success';
                        $icon='fas fa-chalkboard-teacher';
                        break;

                    case 'Aprendiz':
                        $color='secondary';
                        $icon='fas fa-user-graduate';
                        break;

                    default:
                        $color='dark';
                        $icon='fas fa-user';
                }

            @endphp

            <div class="custom-control custom-radio mb-3">

                <input

                    type="radio"

                    id="rol{{ $rol->id }}"

                    name="rol"

                    value="{{ $rol->id }}"

                    class="custom-control-input"

                    {{ old('rol',$rolActual)==$rol->id ? 'checked' : '' }}

                >

                <label

                    class="custom-control-label"

                    for="rol{{ $rol->id }}">

                    <span class="badge badge-{{ $color }}">

                        <i class="{{ $icon }}"></i>

                        {{ $rol->nombre_rol }}

                    </span>

                </label>

            </div>

        @endforeach

    </div>

</div>

        <div class="card">

    <div class="card-header bg-info">

        <h3 class="card-title">

            Información del Perfil

        </h3>

    </div>

    <div class="card-body">

        @if($usuario->instructor)

            <h5>

                Instructor

            </h5>

            <hr>

            <p>

                <strong>Documento:</strong>

                {{ $usuario->instructor->documento_identidad }}

            </p>

            <p>

                <strong>Nombre:</strong>

                {{ $usuario->instructor->nombre_completo }}

            </p>

            <p>

                <strong>Programas:</strong>

            </p>

            @foreach($programas as $programa)

                <div class="custom-control custom-checkbox">

                    <input

                        type="checkbox"

                        name="programas[]"

                        value="{{ $programa->id }}"

                        id="programa{{ $programa->id }}"

                        class="custom-control-input"

                        {{ $usuario->instructor->programas->contains($programa->id) ? 'checked' : '' }}

                    >

                    <label

                        class="custom-control-label"

                        for="programa{{ $programa->id }}">

                        {{ $programa->nombre_programa }}

                    </label>

                </div>

            @endforeach

        @elseif($usuario->aprendiz)

            <h5>

                Aprendiz

            </h5>

            <hr>

            <p>

                <strong>Documento:</strong>

                {{ $usuario->aprendiz->documento_identidad }}

            </p>

            <p>

                <strong>Ficha:</strong>

                {{ optional($usuario->aprendiz->ficha)->numero_ficha }}

            </p>

            <p>

                <strong>Programa:</strong>

                {{ optional(optional($usuario->aprendiz->ficha)->programa)->nombre_programa }}

            </p>

            <p>

                <strong>Estado:</strong>

                {{ optional($usuario->aprendiz->estado)->nombre_estado }}

            </p>

        @else

            <div class="alert alert-warning mb-0">

                Este usuario no tiene un perfil asociado.

            </div>

        @endif

    </div>

</div>

    </div>

    <div class="mt-3">

        <button
            class="btn btn-primary">

            Guardar cambios

        </button>

        <a
            href="{{ route('usuarios.index') }}"
            class="btn btn-secondary">

            Cancelar

        </a>

    </div>

</form>

@stop