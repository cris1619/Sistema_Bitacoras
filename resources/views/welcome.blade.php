<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>

        Sistema de Seguimiento SENA

    </title>

    <!-- Bootstrap (Bootstrap 4 compatible with AdminLTE 3) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        body {

            background:
                linear-gradient(
                    rgba(0,0,0,0.7),
                    rgba(0,0,0,0.7)
                ),
                url('{{ asset("img/fondo-sena.jpg") }}');

            background-size: cover;

            background-position: center;

            background-repeat: no-repeat;

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            color: white;

        }

        .contenedor {

            background: rgba(0,0,0,0.6);

            padding: 50px;

            border-radius: 20px;

            text-align: center;

            max-width: 700px;

            backdrop-filter: blur(6px);

            box-shadow: 0 0 30px rgba(0,0,0,0.5);

        }

        .logo-sena {

            width: 130px;

            margin-bottom: 20px;

        }

        h1 {

            font-size: 40px;

            font-weight: bold;

        }

        p {

            font-size: 18px;

            margin-top: 20px;

        }

        .btn-ingresar {

            margin-top: 30px;

            padding: 12px 30px;

            font-size: 18px;

            border-radius: 10px;

        }

    </style>

</head>

<body>

<div class="contenedor">

    <img
        src="{{ asset('img/logo-sena.png') }}"
        alt="Logo SENA"
        class="logo-sena">

    <h1>

        Sistema de Seguimiento de Bitácoras

    </h1>

    <h3>

        Servicio Nacional de Aprendizaje - SENA

    </h3>

    <p>

        Plataforma para la gestión y seguimiento
        de aprendices en etapa productiva,
        control de bitácoras, evidencias
        y procesos de acompañamiento académico.

    </p>

    <a
        href="{{ route('login') }}"
        class="btn btn-success btn-ingresar">

        <i class="fas fa-sign-in-alt"></i>

        Ingresar al Sistema

    </a>

</div>

</body>

</html>