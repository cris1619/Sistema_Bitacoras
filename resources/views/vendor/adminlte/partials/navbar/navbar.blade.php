<ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown user-menu">

        <a href="#"
           class="nav-link dropdown-toggle d-flex align-items-center"
           data-toggle="dropdown">

            <div class="user-avatar mr-2">
                {{ strtoupper(substr(auth()->user()->nombre_completo,0,1)) }}
            </div>

            <div class="d-none d-md-block text-left">
                <span class="font-weight-bold">
                    {{ auth()->user()->nombre_completo }}
                </span>
            </div>

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow border-0">

            <div class="user-header text-center">

                <div class="avatar-big mx-auto mb-2">
                    {{ strtoupper(substr(auth()->user()->nombre_completo,0,1)) }}
                </div>

                <h6 class="mb-1">
                    {{ auth()->user()->nombre_completo }}
                </h6>

                <small>
                    {{ auth()->user()->rol->nombre ?? 'Usuario' }}
                </small>

            </div>

            <div class="dropdown-divider"></div>

            <div class="px-3 py-2">

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-sena btn-block">

                        <i class="fas fa-sign-out-alt mr-2"></i>

                        Cerrar Sesión

                    </button>

                </form>

            </div>

        </div>

    </li>

</ul>

<style>
    /* Avatar del navbar */

.user-avatar{
    width:35px;
    height:35px;
    border-radius:50%;
    background:#007832;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:16px;
    box-shadow:0 2px 6px rgba(0,0,0,.2);
}

/* Cabecera */

.user-header{
    background:linear-gradient(135deg,#007832,#00A651);
    color:white;
    padding:20px;
}

.avatar-big{
    width:70px;
    height:70px;
    border-radius:50%;
    background:white;
    color:#007832;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    font-weight:bold;
    border:3px solid rgba(255,255,255,.3);
}

.dropdown-menu{
    border-radius:12px;
    overflow:hidden;
}

.btn-sena{
    background:#007832;
    color:white;
    border:none;
    border-radius:8px;
    transition:.3s;
}

.btn-sena:hover{
    background:#005d27;
    color:white;
}

.user-menu .nav-link{
    transition:.3s;
    border-radius:30px;
}

.user-menu .nav-link:hover{
    background:#f3f6f4;
}
</style>