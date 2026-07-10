@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')

<h1>

    Administración de Usuarios

</h1>

@stop

@section('content')

@include('partials.alerts')

<div class="card">

    <div class="card-header">

        <h5>

            Usuarios registrados

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>Nombre</th>

                    <th>Correo</th>

                    <th>Rol</th>

                    <th>Perfil</th>

                    <th>

                        Estado

                    </th>

                    <th width="180">

                        Acciones

                    </th>         

                </tr>

            </thead>

            <tbody>

                @forelse($usuarios as $usuario)

                <tr>

                    <td>

                        {{ $usuario->nombre_completo }}

                    </td>

                    <td>

                        {{ $usuario->email }}

                    </td>

                    <td>

                        @foreach($usuario->roles as $rol)

                            <span class="badge badge-primary">

                                {{ $rol->nombre_rol }}

                            </span>

                        @endforeach

                    </td>

                    <td>

                        @if($usuario->aprendiz)

                            <span class="badge badge-success">

                                Aprendiz

                            </span>

                        @elseif($usuario->instructor)

                            <span class="badge badge-info">

                                Instructor

                            </span>

                        @else

                            <span class="badge badge-dark">

                                Administrador

                            </span>

                        @endif

                    </td>

                    <td>

                        @if($usuario->deleted_at)

                        <button
                            type="button"

                            class="btn btn-success btn-sm"

                            data-toggle="modal"

                            data-target="#modalActivar{{ $usuario->id }}">

                            <i class="fas fa-user-check"></i>

                            Activar

                        </button>

                        @include(

                            'partials.modal-status-user',

                            [

                                'modalId' => 'modalActivar'.$usuario->id,

                                'route' => route('usuarios.activar',$usuario->id),

                                'title' => 'Activar usuario',

                                'message' => '¿Desea volver a activar este usuario? Recuperará inmediatamente el acceso al sistema.',

                                'button' => 'Activar',

                                'color' => 'success',

                                'icon' => 'fas fa-user-check'

                            ]

                        )

                        @else

                        <button
                            type="button"

                            class="btn btn-danger btn-sm"

                            data-toggle="modal"

                            data-target="#modalDesactivar{{ $usuario->id }}">

                            <i class="fas fa-user-slash"></i>

                            Desactivar

                        </button>

                        @include(

                            'partials.modal-status-user',

                            [

                                'modalId' => 'modalDesactivar'.$usuario->id,

                                'route' => route('usuarios.desactivar',$usuario),

                                'title' => 'Desactivar usuario',

                                'message' => '¿Está seguro de desactivar este usuario? No podrá iniciar sesión hasta que vuelva a ser activado.',

                                'button' => 'Desactivar',

                                'color' => 'danger',

                                'icon' => 'fas fa-user-slash'

                            ]

                        )

                        @endif

                    </td>

                    <td>

                        <a
                            href="{{ route('usuarios.show',$usuario) }}"
                            class="btn btn-info btn-sm">

                            Ver

                        </a>

                        <a
                            href="{{ route('usuarios.edit',$usuario) }}"
                            class="btn btn-warning btn-sm">

                            Editar

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">

                        No existen usuarios registrados.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="mt-3">

    {{ $usuarios->links() }}

</div>

@stop