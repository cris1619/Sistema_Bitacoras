@extends('adminlte::page')

@section('title', 'Detalle del Usuario')

@section('content_header')

<h1>

    Información del Usuario

</h1>

@stop

@section('content')

@include('partials.alerts')

<div class="card">

    <div class="card-header bg-primary">

        <h3 class="card-title">

            Información General

        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <p>

                    <strong>Nombre:</strong>

                    {{ $usuario->nombre_completo }}

                </p>

                <p>

                    <strong>Correo:</strong>

                    {{ $usuario->email }}

                </p>

            </div>

            <div class="col-md-6">

                <p>

                    <strong>Rol:</strong>

                    @foreach($usuario->roles as $rol)

                        <span class="badge badge-primary">

                            {{ $rol->nombre_rol }}

                        </span>

                    @endforeach

                </p>

                <p>

                    <strong>Fecha de registro:</strong>

                    {{ $usuario->created_at->format('d/m/Y H:i') }}

                </p>

            </div>

        </div>

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

    <strong>Correo:</strong>

    {{ $usuario->instructor->correo_electronico }}

</p>

<p>

    <strong>Teléfono:</strong>

    {{ $usuario->instructor->telefono }}

</p>

<p>

    <strong>Programas:</strong>

</p>

@foreach($usuario->instructor->programas as $programa)

<span class="badge badge-success">

    {{ $programa->nombre_programa }}

</span>

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

<div class="alert alert-warning">

    Este usuario no tiene un perfil adicional asociado.

</div>

@endif

    </div>

</div>

<div class="mt-3">

    <a

        href="{{ route('usuarios.edit',$usuario) }}"

        class="btn btn-warning">

        <i class="fas fa-edit"></i>

        Editar

    </a>

    <form
    action="{{ route('usuarios.reset-password', $usuario) }}"
    method="POST"
    class="d-inline">

    @csrf

    <button
        type="button"
        class="btn btn-warning"

        data-toggle="modal"

        data-target="#modalResetPassword{{ $usuario->id }}">

        <i class="fas fa-key"></i>

        Restablecer contraseña

    </button>

    @include(
        'partials.modal-reset-password',
        [
            'modalId' => 'modalResetPassword' . $usuario->id,
            'route'   => route('usuarios.reset-password', $usuario),
            'message' => '¿Desea restablecer la contraseña de este usuario? La nueva contraseña será su número de documento.'
        ]
    )

</form>

    <a

        href="{{ route('usuarios.index') }}"

        class="btn btn-secondary">

        Volver

    </a>

</div>

@stop