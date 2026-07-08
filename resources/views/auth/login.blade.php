<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>

        Iniciar Sesión

    </title>

    <!-- Bootstrap (Bootstrap 4 compatible with AdminLTE 3) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->

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

        justify-content: center;

        align-items: center;

    }

    .login-box,
    .register-box {

        background: rgba(0,0,0,0.55);

        backdrop-filter: blur(8px);

        border-radius: 20px;

        padding: 45px;

        box-shadow: 0 0 30px rgba(0,0,0,0.5);

        color: white;

    }

    .login-box {

        width: 420px;

    }

    .register-box {

        width: 500px;

    }

    .logo {

        width: 100px;

        display: block;

        margin: auto;

        margin-bottom: 20px;

    }

    .form-control {

        background: rgba(255,255,255,0.15);

        border: 1px solid rgba(255,255,255,0.2);

        color: white;

    }

    .form-control:focus {

        background: rgba(255,255,255,0.2);

        color: white;

        border-color: #28a745;

        box-shadow: none;

    }

    .form-control::placeholder {

        color: rgba(255,255,255,0.7);

    }

    label {

        margin-bottom: 6px;

    }

    h3 {

        font-weight: bold;

    }

</style>
</head>

<body>

<div class="login-box">

    <img
        src="{{ asset('img/logo-sena.png') }}"
        class="logo">

    <h3 class="text-center mb-4">

        Sistema de Seguimiento

    </h3>

    @if ($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    <form method="POST"
          action="{{ route('login') }}">

        @csrf

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

        <div class="mb-3 form-check">

            <input
                type="checkbox"
                class="form-check-input"
                name="remember">

            <label
                class="form-check-label">

                Recordarme

            </label>

        </div>

        <button
            type="submit"
            class="btn btn-success w-100">

            <i class="fas fa-sign-in-alt"></i>

            Ingresar

        </button>

    </form>

</div>

</body>

</html>