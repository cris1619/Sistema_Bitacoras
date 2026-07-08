<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>

        Registro

    </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

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

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

        }

        .register-box {

            width: 500px;

            background: rgba(255,255,255,0.95);

            border-radius: 20px;

            padding: 40px;

            box-shadow: 0 0 30px rgba(0,0,0,0.4);

        }

        .logo {

            width: 100px;

            display: block;

            margin: auto;

            margin-bottom: 20px;

        }

    </style>

</head>

<body>

<div class="register-box">

    <img
        src="{{ asset('img/logo-sena.png') }}"
        class="logo">

    <h3 class="text-center mb-4">

        Registro de Usuario

    </h3>

    <form method="POST"
          action="{{ route('register') }}">

        @csrf

        <div class="mb-3">

            <label>

                Nombre Completo

            </label>

            <input
                type="text"
                name="nombre_completo"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="text-white">

                Correo Electrónico

            </label>

            <input
                type="email"
                name="email"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="text-white">

                Contraseña

            </label>

            <input
                type="password"
                name="password"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label>

                Confirmar Contraseña

            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                required>

        </div>

        <button
            type="submit"
            class="btn btn-success w-100">

            Registrarse

        </button>

    </form>

</div>

</body>

</html>