
@extends('theme.base')

@section('content')
    <div class="container py-5">
        <h1 class="text-center">Libro diario</h1>
        <a href="{{ route('Registro.create')}}" class="btn btn-secondary">Nueva partida</a>

        <table class="table">
            <thead>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Debe</th>
                <th>Haber</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <tr>
                    <td>Siuuuuu</td>
                    <td>Siuuuu</td>
                    <td>Siuuuu</td>
                    <td>Siuuuu</td>
                    <td>Editar-eliminar</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection