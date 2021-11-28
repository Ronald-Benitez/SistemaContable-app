@extends('theme.base')

@section('css')
    <style>
        .dropper {
        max-height: 200px;
        overflow-y: auto;
    }
    </style>
@endsection

@section('content')
@php
    $sum = array(
        'MD' =>0,
        'MOD'=>0,
        'CIF'=>0,
        'Periodo'=>0
        );
@endphp

<div class="container mt-5 pt-4">
    @include('theme.alert')
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
                @if (session()->get('typeUser')=='admin')
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($Costos as $registro)  
                <tr>
                    <td><b>{{$registro->costoName}}</b></td>
                    <td>${{$registro->monto}}</td>
                    @if ($registro->type=='MD')
                        <td>${{$registro->monto}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                    @if ($registro->type=='MOD')
                        <td></td>
                        <td>${{$registro->monto}}</td>
                        <td></td>
                        <td></td>
                    @endif
                    @if ($registro->type=='CIF')
                        <td></td>
                        <td></td>
                        <td>${{$registro->monto}}</td>
                        <td></td>
                    @endif
                    @if ($registro->type=='Periodo')
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>${{$registro->monto}}</td>
                    @endif
                    @if (session()->get('typeUser')=='admin')
                        <td>
                            <a class="btn btn-warning editar" href="{{route('Costos.edit',$registro->id)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                            <form action="{{ route('Costos.destroy', $registro->id) }}" method="post"
                                class="d-inline">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    @endif
                    
                </tr>
                @php
                    $sum[$registro->type]+=$registro->monto;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th>${{$sum['MD']}}</th>
                <th>${{$sum['MOD']}}</th>
                <th>${{$sum['CIF']}}</th>
                <th>${{$sum['Periodo']}}</th>
                @if (session()->get('typeUser')=='admin')    
                <td><a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#datos">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                        <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                        <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
                      </svg>
                    Datos
                </a></td>
                @endif
            </tr>
            
        </tfoot>
    </table>
    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <a class="btn btn-info me-md-2" href="{{route('Welcome.index') }}"">Volver al inicio</a>
        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#agregarCosto">Ingresar Nuevos costos</a>
        @if (session()->get('typeUser')=='user')    
                <td><a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#datos">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                        <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                        <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
                      </svg>
                    Datos
                </a></td>
                @endif
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Registro de costos Por mes
                </button>
                <ul class="dropdown-menu dropper" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 1) }}">Enero</a></li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 2) }}">Febrero</a></li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 3) }}">Marzo</a></li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 4) }}">Abril</a></li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 5) }}">Mayo</a></li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 6) }}">Junio</a></li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 7) }}">Julio</a></li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 8) }}">Agosto</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 9) }}">Septiembre</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 10) }}">Octubre</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 11) }}">Noviembre</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('Costos.show', 12) }}">Diciembre</a>
                    </li>
                </ul>
            </div>
      </div>
</div>

@include('Costos.create')
@include('Costos.calculos')
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

<script>
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        // These options are needed to round to whole numbers if that's what you want.
        //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
        //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
    });
    $(document).ready(function() {
        
        var ctp = document.getElementById('ctp').innerHTML

        $('#cProduct,#ganacias').on('input', function() {

            var costos = $('#cProduct').val();
            var ganacias = ($('#ganacias').val())/100;
            console.log(formatter.format((ctp/costos)*(1+ganacias)));

            //agignar valores
            $('#costoU').text(formatter.format(ctp/costos));
            $('#precioU').text(formatter.format((ctp/costos)*(1+ganacias)));
            
            $('#precioIVA').text(formatter.format((ctp/costos)*(1+ganacias)*1.13));
        });       
        
    });
   
</script>

@endsection