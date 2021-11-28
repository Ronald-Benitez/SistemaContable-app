@extends('theme.base')
@section('css')
    <style>
        .drop {
            max-height: 200px;
            overflow-y: auto;
        }

    </style>
@endsection

@section('content')
    <div class="container mt-3 py-5">
        <?php
        $partida = 0;
        $fecha = 0;
        session_start();
        ?>

        <h1 class="text-center">Libro diario</h1>

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
        <center>
            <div class="btn-group btn-group-lg my-2 ">
                <a href="{{ route('Registro.create') }}" class="btn btn-outline-dark">Nueva partida</a>
                <div class="dropdown d-flex">
                    <button class="btn btn-outline-dark dropdown-toggle flex-fill" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Libro diario por mes
                    </button>
                    <ul class="dropdown-menu drop" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '1']) }}">Enero</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '2']) }}">Febrero</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '3']) }}">Marzo</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '4']) }}">Abril</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '5']) }}">Mayo</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '6']) }}">Junio</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '7']) }}">Julio</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('Registro.show', ['Registro' => '8']) }}">Agosto</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('Registro.show', ['Registro' => '9']) }}">Septiembre</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('Registro.show', ['Registro' => '10']) }}">Octubre</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('Registro.show', ['Registro' => '11']) }}">Noviembre</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('Registro.show', ['Registro' => '12']) }}">Diciembre</a>
                        </li>
                    </ul>
                </div>
            </div>
        </center>
        <table class="table">
            <thead>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Debe ($)</th>
                <th>Haber ($)</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($registros as $registro)
                    @if (isset($concepto) && $partida != $registro->partida)
                        <tr>
                            <td></td>
                            <td> <i>{{ $concepto }}</i> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php
                            $concepto = $registro->concepto;
                        @endphp
                    @endif
                    @if ($partida != $registro->partida)
                        <tr>
                            <td>{{ $registro->created_at }}</td>
                            <td><b>Px{{ $registro->partida }}</b></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="{{ route('Registro.edit', ['Registro' => $registro->partida]) }}"
                                    class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pen" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                    </svg>
                                </a>
                                <form action="{{ route('Registro.destroy', ['Registro' => $registro->partida]) }}"
                                    method="post" class="d-inline">
                                    @method("delete")
                                    @csrf
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Seguro que desea eliminar?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $partida = $registro->partida;
                        $fecha = $registro->created_at;
                        $concepto = $registro->concepto;
                        ?>
                    @endif

                    <tr>
                        <td></td>
                        <td>{{ $registro->nombre }}</td>
                        @if ($registro->tipoM == 1)
                            <td class="debe">{{ $registro->monto }}</td>
                            <td class="haber"></td>
                        @else
                            <td class="debe"></td>
                            <td class="haber">{{ $registro->monto }}</td>
                        @endif
                        <td></td>
                    </tr>

                @endforeach
                <tr>
                    <td></td>
                    <td> <i>{{ $concepto }}</i> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="container">
            <div class="input-group">
                <span class="input-group-text">Debe</span>
                <input type="text" readonly class="form-control balance" id="debe">
                <span class="input-group-text">Haber</span>
                <input type="text" readonly class="form-control balance" id="haber">

            </div>
        </div>
    </div>
    <a href="{{ route('Welcome.index') }}" class="btn btn-secondary ms-5 mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path
                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
        </svg>
        Volver al inicio
    </a>
@endsection

@section('script')
    <script>
        $(function() {
            let debe = document.querySelectorAll(".debe");
            let haber = document.querySelectorAll(".haber");
            let sDebe = 0;
            let sHaber = 0;

            debe.forEach(function(item) {
                if (item.innerHTML != "") {
                    sDebe += parseFloat(item.innerHTML);
                    (item.innerHTML, 10)
                }
            })
            haber.forEach(function(item) {
                if (item.innerHTML != "") {
                    sHaber += parseFloat(item.innerHTML);
                    (item.innerHTML, 10)
                }
            })

            setTimeout(() => {
                $(".alert").remove();
            }, 5000);

            $("#debe").val(currency(sDebe))
            $("#haber").val(currency(sHaber))
        });

        const currency = function(number) {
            return new Intl.NumberFormat('en-IN', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2
            }).format(number);
        };
    </script>

@endsection
