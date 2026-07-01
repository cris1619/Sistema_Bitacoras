@extends('adminlte::page')

@section('title', 'Editar Programa')

@section('content_header')

    <h1>Editar Programa</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('programas.update', $programa) }}"
            method="POST">

            @csrf
            @method('PUT')

            <!-- Código -->

            <div class="mb-3">

                <label class="form-label">

                    Código Programa
                </label>

                <input
                    type="text"
                    name="codigo_programa"
                    class="form-control @error('codigo_programa') is-invalid @enderror"
                    value="{{ old('codigo_programa', $programa->codigo_programa) }}"
                >

                @error('codigo_programa')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <!-- Nombre -->

            <div class="mb-3">

                <label class="form-label">

                    Nombre Programa
                </label>

                <input
                    type="text"
                    name="nombre_programa"
                    class="form-control @error('nombre_programa') is-invalid @enderror"
                    value="{{ old('nombre_programa', $programa->nombre_programa) }}"
                >

                @error('nombre_programa')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <!-- Nivel -->

            <div class="mb-3">

                <label class="form-label">

                    Nivel Formación
                </label>

                <select
                    name="nivel_formacion"
                    class="form-select @error('nivel_formacion') is-invalid @enderror">

                    <option value="">

                        Seleccione

                    </option>

                    <option
                        value="Técnico"
                        {{ $programa->nivel_formacion == 'Técnico' ? 'selected' : '' }}>

                        Técnico

                    </option>

                    <option
                        value="Tecnólogo"
                        {{ $programa->nivel_formacion == 'Tecnólogo' ? 'selected' : '' }}>

                        Tecnólogo

                    </option>

                    <option
                        value="Especialización"
                        {{ $programa->nivel_formacion == 'Especialización' ? 'selected' : '' }}>

                        Especialización

                    </option>

                </select>

                @error('nivel_formacion')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <button class="btn btn-primary">

                Actualizar Programa

            </button>

            <a href="{{ route('programas.index') }}"
               class="btn btn-secondary">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop