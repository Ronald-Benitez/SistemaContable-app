@extends('theme.base')

@section('content')
    @php
    $flag = $registros[0]->nombre;
    $flag = 0;
    $sumDebe = 0; //izquierda
    $sumHaber = 0;
    @endphp
    <div class="container mt-3">
        <p class="fs-1 text-center rounded-pill border border-dark ">Libro mayor</p>
    </div>

    <div class="container-sm d-flex flex-row flex-wrap justify-content-between ">
        <div class="col-3 m-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="4" class="text-center">{{ $registros[0]->nombre }}</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($registros as $cuenta)

                        @if ($cuenta->nombre != $flag)

                </tbody>
                <tfoot>
                    <tr>
                        <td class="col-sm-2"></td>
                        <td class="border-end col-sm-2"><b>{{ "$ " . $sumDebe }}</b></td>
                        <td class="col-sm-2"><b>{{ "$ " . $sumHaber }}</b> </td>
                        <td class="col-sm-2"> </td>
                    </tr>
                    {{-- RESULTAODS --}}
                    <tr class="table-secondary">
                        @if ($sumDebe > $sumHaber)
                            <td colspan="2" class="col-sm-2 border-end"><b>Total: <i>$ {{ $sumDebe - $sumHaber }}</i></b>
                            </td>
                            <td colspan="2" class="col-sm-2"></td>
                        @else
                            <td colspan="2" class="col-sm-2 border-end"></td>
                            <td colspan="2" class="col-sm-2"><b>Total: <i> ${{ $sumHaber - $sumDebe }}</i></b></td>
                        @endif
                    </tr>
                    @php
                        $flag = $cuenta->nombre;
                        $sumDebe = 0;
                        $sumHaber = 0;
                    @endphp
                </tfoot>

            </table>
        </div>

        <div class="col-3 m-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="4" class="text-center">{{ $cuenta->nombre }}</th>
                    </tr>
                </thead>
                <tbody>
                    @endif

                    <tr>
                        @if ($cuenta->tipoM == '1')
                            <td class="col-sm-2"><i>{{ $cuenta->partida }}</i></td>
                            <td class="border-end col-sm-2"><b>$ {{ $cuenta->monto }}</b></td>
                            <td class="col-sm-2"> </td>
                            <td class="col-sm-2"> </td>
                            @php
                                $sumDebe += $cuenta->monto;
                            @endphp

                        @else
                            <td class="col-sm-2"> </td>
                            <td class="border-end col-sm-2"> </td>
                            <td class="col-sm-2"><b>$ {{ $cuenta->monto }}</b></td>
                            <td class="col-sm-2"><i>{{ $cuenta->partida }}</i></td>
                            @php
                                $sumHaber += $cuenta->monto;
                            @endphp
                        @endif
                    </tr>


                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="col-sm-2"></td>
                        <td class="border-end col-sm-2">{{ "$ " . $sumDebe }}</td>
                        <td class="col-sm-2">{{ "$ " . $sumHaber }} </td>
                        <td class="col-sm-2"> </td>
                    </tr>
                    {{-- RESULTAODS --}}
                    <tr class="table-secondary">
                        @if ($sumDebe > $sumHaber)
                            <td colspan="2" class="col-sm-2 border-end"><b>Total: <i>$ {{ $sumDebe - $sumHaber }}</i></b>
                            </td>
                            <td colspan="2" class="col-sm-2"></td>
                        @else
                            <td colspan="2" class="col-sm-2 border-end"></td>
                            <td colspan="2" class="col-sm-2"><b>Total: <i> ${{ $sumHaber - $sumDebe }}</i></b></td>
                        @endif
                    </tr>

                </tfoot>
            </table>
        </div>
    </div>
    <i class="bi bi-arrow-left-circle-fill"></i>

    <a href="/SistemaContable-app/public/" class="btn btn-secondary ms-5 mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path
                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
        </svg>
        Volver al inicio
    </a>
@endsection
