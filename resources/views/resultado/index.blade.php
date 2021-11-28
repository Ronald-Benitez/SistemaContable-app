@extends('theme.base')

@section('content')
    @php
    $suma = 0;
    @endphp
    <div class="container mt-5 pt-4">
        <p class="fs-1 text-center rounded-pill border border-dark ">Estado de resultados</p>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th colspan="2">Estado de resultados</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>Ingresos</td>
                        <td>{{ number_format($ingreso, 2) }}</td>
                        @php
                            $suma = $ingreso;
                        @endphp
                    </tr>
                    <tr>
                        <td>(-)</td>
                        <td>Costos</td>
                        <td>{{ number_format($costo, 2) }}</td>
                        @php
                            $suma -= $costo;
                        @endphp
                    </tr>
                    <tr>
                        <td>(=)</td>
                        <td><b>Utilidad bruta</b></td>
                        <td><b>{{ number_format($suma, 2) }}</b></td>
                    </tr>
                    <tr>
                        <td>(-)</td>
                        <td>Gastos de operación</td>
                        <td>{{ number_format($gasto, 2) }}</td>
                        @php
                            $suma -= $gasto;
                        @endphp
                    </tr>
                    <tr>
                        <td>(=)</td>
                        <td><b>Utilidad antes de operación</b></td>
                        <td><b>{{ number_format($suma, 2) }}</b></td>
                    </tr>
                    <tr>
                        <td>(-)</td>
                        <td>Reserva legal</td>
                        @if ($suma > 0)
                            <td>{{ number_format($suma * 0.07, 2) }}</td>
                            @php
                                $suma -= number_format($suma * 0.07, 2);
                            @endphp
                        @else
                            <td>-</td>
                        @endif
                    </tr>
                    <tr>
                        <td>(=)</td>
                        <td><b>Utilidad antes de impuesto</b></td>
                        <td><b>{{ number_format($suma, 2) }}</b></td>
                    </tr>
                    <tr>
                        <td>(-)</td>
                        <td>Impuestos por pagar</td>
                        @if ($suma > 0)
                            @if ($suma > 150000)
                                <td>{{ number_format($suma * 0.3, 2) }}</td>
                                @php
                                    $suma -= round($suma * 0.3, 2);
                                @endphp
                            @else
                                <td>{{ number_format($suma * 0.25, 2) }}</td>
                                @php
                                    $suma -= round($suma * 0.25, 2);
                                @endphp
                            @endif

                        @else
                            <td>-</td>
                        @endif
                    </tr>

                <tfoot>
                    <tr>
                        <td>(=)</td>
                        @if ($suma > 0)
                            <td><b> Utilidad neta</b></td>
                        @else
                            <td><b>Perdida neta</b></td>
                        @endif
                        <td><b>{{ number_format($suma, 2) }}</b></td>
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
