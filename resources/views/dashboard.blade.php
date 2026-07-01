@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel Principal</h1>
@stop

@section('content')

<div class="row">

    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>0</h3>

                <p>Aprendices</p>

            </div>

            <div class="icon">
                <i class="fas fa-users"></i>
            </div>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>0</h3>

                <p>Seguimientos</p>

            </div>

            <div class="icon">
                <i class="fas fa-clipboard-check"></i>
            </div>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>0</h3>

                <p>Bitácoras</p>

            </div>

            <div class="icon">
                <i class="fas fa-book"></i>
            </div>

        </div>

    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>0</h3>

                <p>Usuarios</p>

            </div>

            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>

        </div>

    </div>

</div>

@stop