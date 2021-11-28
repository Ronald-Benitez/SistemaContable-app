@extends('theme.base')

@section('css')
    <style>
        .dropdown-menu {
            max-height: 200px;
            overflow-y: auto;
        }

    </style>
@endsection

@section('content')
    @php
    $count = 0;
    $nombres = ['Activo', 'Pasivo', 'Capital'];
    $debe = 0;
    $haber = 0;
    session_start();
    @endphp
    <div class="container mt-5 pt-3">
        <p class="fs-1 text-center rounded-pill border border-dark ">Balance de general</p>
    </div>
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

            <div class="dropdown d-flex">
                <button class="btn btn-outline-dark dropdown-toggle flex-fill" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Balance general por mes
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('General.show', '1') }}">Enero</a></li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '2') }}">Febrero</a></li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '3') }}">Marzo</a></li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '4') }}">Abril</a></li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '5') }}">Mayo</a></li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '6') }}">Junio</a></li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '7') }}">Julio</a></li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '8') }}">Agosto</a></li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '9') }}">Septiembre</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '10') }}">Octubre</a></li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '11') }}">Noviembre</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('General.show', '12') }}">Diciembre</a>
                    </li>
                </ul>
            </div>
        </div>
    </center>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Concepto</th>
                        <th>Debe</th>
                        <th>Haber</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $dato)

                        <tr>
                            <td></td>
                            <td><b>{{ $nombres[$count] }}</b></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php
                            $count++;
                        @endphp

                        @foreach ($dato as $row)
                            <tr>
                                <td>{{ $row->idC }}</td>
                                <td>{{ $row->nombre }}</td>
                                @if ($row->saldo >= 0)
                                    @if ($row->tipoC == '1')
                                        <td>{{ number_format(abs($row->saldo), 2) }}</td>
                                        <td></td>
                                        @php
                                            $debe += abs($row->saldo);
                                        @endphp
                                    @else
                                        <td></td>
                                        <td>{{ number_format(abs($row->saldo), 2) }}</td>
                                        @php
                                            $haber += abs($row->saldo);
                                        @endphp
                                    @endif
                                @else
                                    @if ($row->tipoC == '1')
                                        <td></td>
                                        <td>{{ number_format(abs($row->saldo), 2) }}</td>
                                        @php
                                            $haber += abs($row->saldo);
                                        @endphp
                                    @else
                                        @php
                                            $debe += abs($row->saldo);
                                        @endphp
                                        <td>{{ number_format(abs($row->saldo), 2) }}</td>
                                        <td></td>
                                    @endif
                                @endif

                        @endforeach
                    @endforeach
                <tfoot>
                    <tr>
                        <td></td>
                        <td><b>Total</b></td>
                        <td><b>{{ $debe }}</b></td>
                        <td><b>{{ $haber }}</b></td>
                    </tr>
                </tfoot>

                </tbody>
            </table>
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
            setTimeout(() => {
                $(".alert").remove();
            }, 5000);

            $("#debe").val(currency(sDebe))
            $("#haber").val(currency(sHaber))
        });
    </script>

@endsection
