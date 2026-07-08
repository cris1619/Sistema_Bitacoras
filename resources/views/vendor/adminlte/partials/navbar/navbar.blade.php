<ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown user-menu">

        <a href="#"
           class="nav-link dropdown-toggle"
           role="button"
           aria-haspopup="true"
           aria-expanded="false"
           data-toggle="dropdown">

            <i class="fas fa-user-circle"></i>

            <span class="d-none d-md-inline">
                {{ auth()->user()->nombre_completo }}
            </span>

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <div class="user-footer px-3 py-2">

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-danger btn-block btn-flat">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        Cerrar Sesión
                    </button>

                </form>

            </div>

        </div>

    </li>

</ul>