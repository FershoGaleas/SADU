<!-- Estilos para subrayado dinámico -->
<style>
    .nav-link {
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0%;
        height: 2px;
        background-color: white;
        transition: width 0.3s ease;
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark w-100" style="background: linear-gradient(90deg,rgba(0, 135, 189, 1) 0%, rgba(65, 217, 128, 1) 50%, rgba(80, 232, 53, 1) 100%);">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('build/assets/SADU.png') }}" alt="Logo" style="height: 60px;" class="me-2">
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Enlaces -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        {{ __('Principal') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold {{ request()->routeIs('create_formulario') ? 'active' : '' }}" href="{{ route('create_formulario') }}">
                        {{ __('Agregar Paciente') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold {{ request()->routeIs('busqueda_sala_usuario') ? 'active' : '' }}" href="{{ route('busqueda_sala_usuario') }}">
                        {{ __('Sala de Espera') }}
                        @if(isset($conteoSala) && $conteoSala > 0)
                            <span class="badge bg-danger rounded-pill">{{$conteoSala}}</span>
                        @endif
                    </a>
                </li>

                @auth
                    @if(auth()->user()->rol === 'admin')
                        <li class="nav-item">
                            <a class="nav-link text-white fw-semibold {{ request()->routeIs('pacientes.index') ? 'active' : '' }}" href="{{ route('pacientes.index') }}">
                                {{ __('Listado Pacientes') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white fw-semibold {{ request()->routeIs('admin.usuarios') ? 'active' : '' }}" href="{{ route('admin.usuarios') }}">
                                {{ __('Control de Usuarios') }}
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Dropdown de usuario -->
            @auth
                <div class="p-3">
                    <button class="btn btn-light" onclick="location.reload();">
                        Actualizar
                    </button>
                </div>


                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle fw-semibold" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">{{ __('Cerrar Sesión') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>