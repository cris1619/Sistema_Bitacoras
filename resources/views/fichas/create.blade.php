@extends('adminlte::page')

@section('title', 'Nueva Ficha')

@section('content_header')

    <h1>Registrar Ficha</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form
            action="{{ route('fichas.store') }}"
            method="POST">

            @csrf

            <!-- Número Ficha -->

            <div class="mb-3">

                <label class="form-label">

                    Número de Ficha

                </label>

                <input
                    type="text"
                    name="numero_ficha"
                    class="form-control @error('numero_ficha') is-invalid @enderror"
                    value="{{ old('numero_ficha') }}"
                >

                @error('numero_ficha')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <!-- Programa -->

            <div class="mb-3">

                <label class="form-label">

                    Programa de Formación

                </label>

                <select
                    name="programa_id"
                    class="form-select @error('programa_id') is-invalid @enderror">

                    <option value="">

                        Seleccione un programa

                    </option>

                    @foreach($programas as $programa)

                        <option
                            value="{{ $programa->id }}">

                            {{ $programa->nombre_programa }}

                        </option>

                    @endforeach

                </select>

                @error('programa_id')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <button class="btn btn-success">

                Guardar Ficha

            </button>

            <a href="{{ route('fichas.index') }}"
               class="btn btn-secondary">

                Cancelar

            </a>

        </form>

    </div>

</div>

@stop