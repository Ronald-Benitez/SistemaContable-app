@extends('theme.base')

@section('content')
    @php
    $count = 0;
    $nombres = ['Activo', 'Pasivo', 'Capital', 'Ingresos', 'Costos', 'Gastos'];
    $debe = 0;
    $haber = 0;
    @endphp
    <div class="container mt-5 pt-5">
        <p class="fs-1 text-center rounded-pill border border-dark ">Balance de comprobación</p>
    </div>
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
                                    @if ($row->tipoC == '1' || $row->tipoC == '5' || $row->tipoC == '6')
                                        <td>{{ abs($row->saldo) }}</td>
                                        <td></td>
                                        @php
                                            $debe += abs($row->saldo);
                                        @endphp
                                    @else
                                        <td></td>
                                        <td>{{ abs($row->saldo) }}</td>
                                        @php
                                            $haber += abs($row->saldo);
                                        @endphp
                                    @endif
                                @else
                                    @if ($row->tipoC == '1' || $row->tipoC == '5' || $row->tipoC == '6')
                                        <td></td>
                                        <td>{{ abs($row->saldo) }}</td>
                                        @php
                                            $haber += abs($row->saldo);
                                        @endphp
                                    @else
                                        @php
                                            $debe += abs($row->saldo);
                                        @endphp
                                        <td>{{ abs($row->saldo) }}</td>
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
