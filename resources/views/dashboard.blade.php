@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<div class="d-flex justify-content-between align-items-center mb-2">

    <div>

        <h2 class="font-weight-bold text-success mb-0">

            Bienvenido, {{ auth()->user()->nombre_completo }}

        </h2>

        <small class="text-muted">

            Sistema de Seguimiento de Bitácoras SENA

        </small>

    </div>

    <span class="badge badge-success p-2">

        {{ now()->format('d/m/Y') }}

    </span>

</div>

@stop


@section('content')

<div class="row">

    <!-- Aprendices -->

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            APRENDICES

                        </small>

                        <h2 class="font-weight-bold mt-2">

                            {{ $totalAprendices }}

                        </h2>

                    </div>

                    <div class="bg-primary rounded-circle p-3">

                        <i class="fas fa-users fa-2x text-white"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Bitácoras -->

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            BITÁCORAS

                        </small>

                        <h2 class="font-weight-bold mt-2">

                            {{ $totalBitacoras }}

                        </h2>

                    </div>

                    <div class="bg-success rounded-circle p-3">

                        <i class="fas fa-book fa-2x text-white"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Pendientes -->

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            PENDIENTES

                        </small>

                        <h2 class="font-weight-bold mt-2">

                            {{ $pendientes }}

                        </h2>

                    </div>

                    <div class="bg-warning rounded-circle p-3">

                        <i class="fas fa-clock fa-2x text-white"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Seguimientos -->

    <div class="col-lg-3 col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">

                            SEGUIMIENTOS

                        </small>

                        <h2 class="font-weight-bold mt-2">

                            {{ $seguimientos }}

                        </h2>

                    </div>

                    <div class="bg-danger rounded-circle p-3">

                        <i class="fas fa-clipboard-check fa-2x text-white"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="row mt-4">

    <div class="col-lg-8">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="fas fa-bolt text-success mr-2"></i>

                    Accesos rápidos

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <a href="{{ route('aprendices.index') }}"
                           class="btn btn-outline-primary btn-block btn-lg">

                            <i class="fas fa-users mb-2"></i>

                            <br>

                            Aprendices

                        </a>

                    </div>

                    <div class="col-md-4 mb-3">

                        <a href="{{ route('bitacoras.index') }}"
                           class="btn btn-outline-success btn-block btn-lg">

                            <i class="fas fa-book mb-2"></i>

                            <br>

                            Bitácoras

                        </a>

                    </div>

                    <div class="col-md-4 mb-3">

                        <a href="{{ route('seguimientos.index') }}"
                           class="btn btn-outline-warning btn-block btn-lg">

                            <i class="fas fa-clipboard-check mb-2"></i>

                            <br>

                            Seguimientos

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="fas fa-chart-pie text-success mr-2"></i>

                    Resumen

                </h5>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <strong>Estado del sistema</strong>

                    <div class="progress mt-2">

                        <div class="progress-bar bg-success"

                             style="width:100%">

                            Operativo

                        </div>

                    </div>

                </div>

                <hr>

                <p>

                    <strong>Total Aprendices:</strong>

                    {{ $totalAprendices }}

                </p>

                <p>

                    <strong>Bitácoras Registradas:</strong>

                    {{ $totalBitacoras }}

                </p>

                <p>

                    <strong>Seguimientos:</strong>

                    {{ $seguimientos }}

                </p>

                <p>

                    <strong>Pendientes:</strong>

                    {{ $pendientes }}

                </p>

                <hr>

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button class="btn btn-danger btn-block">

                        <i class="fas fa-sign-out-alt mr-2"></i>

                        Cerrar sesión

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@stop