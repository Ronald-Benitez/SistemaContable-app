@extends('theme.base')

@section('content')
    <div class="container py-5">
        <h1 class="text-center">Working in progress</h1>

        @if (isset($_SESSION['estado']))
            <div class="alert alert-{{ $_SESSION['alert'] }}" role="alert">
                {{ $_SESSION['estado'] }}
            </div>
        @endif

        <?php
        if (isset($_SESSION['estado'])) {
            unset($_SESSION['estado']);
            unset($_SESSION['alert']);
        }
        ?>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            {{-- Libro diario --}}
            <a href="{{ route('Registro.index') }}" class="btn btn-secondary m-2">Libro diario actual</a>
            <div class="dropdown m-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Libro diario por mes
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '1']) }}">Enero</a></li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '2']) }}">Febrero</a></li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '3']) }}">Marzo</a></li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '4']) }}">Abril</a></li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '5']) }}">Mayo</a></li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '6']) }}">Junio</a></li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '7']) }}">Julio</a></li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '8']) }}">Agosto</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '9']) }}">Septiembre</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '10']) }}">Octubre</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '11']) }}">Noviembre</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '12']) }}">Diciembre</a>
                    </li>
                </ul>
            </div>

            {{-- Libro mayor --}}
            <a href="{{ route('mayor.index') }}" class="btn btn-secondary m-2">Libro mayor actual</a>
            <div class="dropdown m-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Libro mayor por mes
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '1') }}">Enero</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '2') }}">Febrero</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '3') }}">Marzo</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '4') }}">Abril</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '5') }}">Mayo</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '6') }}">Junio</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '7') }}">Julio</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '8') }}">Agosto</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '9') }}">Septiembre</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '10') }}">Octubre</a></li>
                    <li><a class="dropdown-item" href="{{ route('mayor.show', '11') }}">Noviembre</a></li>
                    <li><a class="dropdown-item" href="{{ route('Registro.show', '12') }}">Diciembre</a></li>
                </ul>
            </div>

        </div>

        {{-- Balance de comprobación --}}
        <a href=" {{ route('Comprobacion.index') }}" class="btn btn-secondary m-2">Balance de comprobación actual</a>
        <div class="dropdown m-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Balance de comprobación por mes
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '1') }}">Enero</a></li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '2') }}">Febrero</a></li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '3') }}">Marzo</a></li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '4') }}">Abril</a></li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '5') }}">Mayo</a></li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '6') }}">Junio</a></li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '7') }}">Julio</a></li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '8') }}">Agosto</a></li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '9') }}">Septiembre</a>
                </li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '10') }}">Octubre</a></li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '11') }}">Noviembre</a>
                </li>
                <li><a class="dropdown-item" href="{{ route('Comprobacion.show', '12') }}">Diciembre</a>
                </li>
            </ul>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            setTimeout(() => {
                $(".alert").remove();
            }, 5000);

            $("#debe").val(currency(sDebe))
            $("#haber").val(currency(sHaber))
        });
    </script>

@endsection
