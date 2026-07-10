<nav x-data="{ open: false }" class="bg-[#007832] shadow-lg border-b border-green-800">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center space-x-3">

                    <img src="{{ asset('images/logo-sena.png') }}"
                         class="h-10">

                    <div class="hidden md:block text-white">

                        <h1 class="font-bold text-lg">
                            Sistema de Bitácoras
                        </h1>

                        <p class="text-xs text-green-100">
                            SENA
                        </p>

                    </div>

                </a>

            </div>

            <!-- Menú -->
            <div class="hidden sm:flex items-center space-x-6">

                <a href="{{ route('dashboard') }}"
                   class="text-white hover:text-green-200 font-medium transition">

                    <i class="fas fa-home mr-1"></i>

                    Dashboard

                </a>

            </div>

            <!-- Usuario -->
            <div class="hidden sm:flex items-center">

                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">

                        <button
                            class="flex items-center space-x-3 bg-white/10 hover:bg-white/20 rounded-full px-3 py-2 transition">

                            <div
                                class="w-10 h-10 rounded-full bg-white text-[#007832] flex items-center justify-center font-bold text-lg">

                                {{ strtoupper(substr(Auth::user()->nombre_completo,0,1)) }}

                            </div>

                            <div class="text-left">

                                <p class="text-white font-semibold text-sm">

                                    {{ Auth::user()->nombre_completo }}

                                </p>

                                <p class="text-green-100 text-xs">

                                    {{ Auth::user()->rol->nombre ?? 'Usuario' }}

                                </p>

                            </div>

                            <svg class="w-4 h-4 text-white"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 20 20">

                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.939a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"/>

                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <div class="px-4 py-3 border-b">

                            <p class="font-semibold">

                                {{ Auth::user()->nombre_completo }}

                            </p>

                            <p class="text-sm text-gray-500">

                                {{ Auth::user()->email }}

                            </p>

                        </div>

                        <x-dropdown-link :href="route('profile.edit')">

                            👤 Mi Perfil

                        </x-dropdown-link>

                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">

                                🚪 Cerrar sesión

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Responsive -->

            <div class="flex items-center sm:hidden">

                <button @click="open=!open"
                    class="text-white">

                    <svg class="h-7 w-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>

                    </svg>

                </button>

            </div>

        </div>

    </div>

</nav>

<style>
    nav{
    font-family: 'Segoe UI', sans-serif;
}

[x-cloak]{
    display:none;
}

.dropdown-content{
    border-radius:12px;
    overflow:hidden;
}

button:focus{
    outline:none;
}

a{
    transition:.3s;
}

a:hover{
    text-decoration:none;
}
</style>