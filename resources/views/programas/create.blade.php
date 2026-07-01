@extends('adminlte::page')

@section('title', 'Nuevo Programa')

@section('content_header')

    <h1>Registrar Programa</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('programas.store') }}"
              method="POST">

            @csrf

            <!-- Código -->

            <div class="mb-3">

                <label class="form-label">

                    Código Programa
                </label>

                <input
                    type="text"
                    name="codigo_programa"
                    class="form-control @error('codigo_programa') is-invalid @enderror"
                    value="{{ old('codigo_programa') }}"
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
                    value="{{ old('nombre_programa') }}"
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

                    <option value="Técnico">

                        Técnico

                    </option>

                    <option value="Tecnólogo">

                        Tecnólogo

                    </option>

                    <option value="Especialización">

                        Especialización

                    </option>

                </select>

                @error('nivel_formacion')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <button class="btn btn-success">

                Guardar Programa

            </button>

            <a href="{{ route('programas.index') }}"
               class="btn btn-secondary">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop