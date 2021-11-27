@extends('theme.base')

@section('content')
@php
    $sum = array(
        'MD' =>0,
        'MOD'=>0,
        'CIF'=>0,
        'Periodo'=>0
        );
@endphp

@include('theme.alert')
<div class="container mt-5">
    @error('costoName')
        <div class="alert alert-warning mensaje">
            {{ $message }}
        </div>
    @enderror
    @error('monto')
        <div class="alert alert-warning mensaje">
            {{ $message }}
        </div>
    @enderror
    @error('type')
        <div class="alert alert-warning mensaje">
            {{ $message }}
        </div>
    @enderror
    <table class="table table-striped ">
        <thead>
            <tr>
                <td colspan="2"></td>
                <td colspan="4" class="table-secondary text-center">Tipo de costo</td>
            </tr>
            <tr>
                <th>Costo</th>
                <th>Monto</th>
                <th>MD</th>
                <th>MOD</th>
                <th>CIF</th>
                <th>Periodo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Costos as $registro)  
                <tr>
                    <td><b>{{$registro->costoName}}</b></td>
                    <td>${{$registro->monto}}</td>
                    @if ($registro->type=='MD')
                        <th>${{$registro->monto}}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    @endif
                    @if ($registro->type=='MOD')
                        <th></th>
                        <th>${{$registro->monto}}</th>
                        <th></th>
                        <th></th>
                    @endif
                    @if ($registro->type=='CIF')
                        <th></th>
                        <th></th>
                        <th>${{$registro->monto}}</th>
                        <th></th>
                    @endif
                    @if ($registro->type=='Periodo')
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>${{$registro->monto}}</th>
                    @endif
                    <td>
                        <a class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                              </svg>
                        </a>
                    </td>
                </tr>
                @php
                    $sum[$registro->type]+=$registro->monto;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Total</td>
                <td>${{$sum['MD']}}</td>
                <td>${{$sum['MOD']}}</td>
                <td>${{$sum['CIF']}}</td>
                <td>${{$sum['Periodo']}}</td>
            </tr>
            
        </tfoot>
    </table>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-info me-md-2"">Volver al inicio</a>
        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#agregarCosto">Ingresar Nuevos costos</a>
      </div>
</div>

@include('Costos.create')
@endsection


@section('script')
<script>
    var myModal = document.getElementById('agregarCosto')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
    })
</script>

<script>
    setTimeout(() => {
        $(".mensaje").remove();
    }, 5000);
</script>
@endsection