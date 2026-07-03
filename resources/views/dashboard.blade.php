@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<h1>

    Dashboard Administrativo

</h1>

@stop

@section('content')

<div class="row">

    <!-- APRENDICES -->

    <div class="col-md-3">

        <div class="small-box bg-primary">

            <div class="inner">

                <h3>

                    {{ $totalAprendices }}

                </h3>

                <p>

                    Aprendices

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-users"></i>

            </div>

        </div>

    </div>

    <!-- BITACORAS -->

    <div class="col-md-3">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>

                    {{ $totalBitacoras }}

                </h3>

                <p>

                    Bitácoras

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-book"></i>

            </div>

        </div>

    </div>

    <!-- PENDIENTES -->

    <div class="col-md-3">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>

                    {{ $pendientes }}

                </h3>

                <p>

                    Pendientes

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-clock"></i>

            </div>

        </div>

    </div>

    <!-- SEGUIMIENTOS -->

    <div class="col-md-3">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>

                    {{ $seguimientos }}

                </h3>

                <p>

                    Seguimientos

                </p>

            </div>

            <div class="icon">

                <i class="fas fa-clipboard-check"></i>

            </div>

        </div>

    </div>

</div>

<!-- TABLA RECIENTES -->

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Accesos rápidos

        </h3>

    </div>

    <div class="card-body">

        <a href="{{ route('aprendices.index') }}"
           class="btn btn-primary">

            Aprendices

        </a>

        <a href="{{ route('seguimientos.index') }}"
           class="btn btn-success">

            Seguimientos

        </a>

        <a href="{{ route('bitacoras.index') }}"
           class="btn btn-warning">

            Bitácoras

        </a>

        <form
    action="{{ route('logout') }}"
    method="POST">

    @csrf

    <button
        type="submit"
        class="btn btn-danger">

        Cerrar Sesión

    </button>

</form>

    </div>

</div>

@stop