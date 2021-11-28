<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('Welcome.index') }}">
            <img src="https://lh3.googleusercontent.com/JGMtspdFiOVpDmBaGC15E4L_WZWmzJHjQrB_qAV3aqwRM3WN-pdHKcwNdHf8inBLcxhElJClPMvIj-ljVcKV1GzJokNqEZlpWGs"
                alt="" width="30" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('Welcome.index') }}">Inicio</a>
                </li>
                <li class="nav-item dropdown">

                    {{-- Usuario --}}
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>
                        {{ session()->get('username') }}

                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">

                        <li>
                            <a class="dropdown-item" href="{{ route('login.logout') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                    <path fill-rule="evenodd"
                                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                </svg>
                                Cerrar Session
                            </a>
                        </li>
                    </ul>
                    {{-- Admin Estados --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Estados Financieros
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('Registro.index') }}">
                                Libro diario
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('Registro.create') }}">
                                Agregar partida
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('mayor.index') }}">
                                Libro mayor
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('Comprobacion.index') }}">
                                Balance de Comprobacion
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('Resultados.index') }}">
                                Estado de Resultados
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('General.index') }}">
                                Balance General
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Admin usuarios --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Usuarios
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('Usuario.index') }}">
                                Administrar usuarios
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('Usuario.create') }}">
                                Agregar Usuarios
                            </a>
                        </li>

                    </ul>


                </li>
                {{-- Costos --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Costos
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('Costos.index') }}">
                                Sistema de costos
                            </a>
                        </li>

                    </ul>

                    {{-- Fin costos --}}

            </ul>

        </div>
    </div>
</nav>
