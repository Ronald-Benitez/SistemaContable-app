@extends('theme.base')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection

@section('content')

    <div class="card my-5" style="width:99%">
        <div class="card-title text-center my-4">
            <h3>Registro de usuarios</h3>
        </div>
        @include("theme.alert")
        <div class="card-body">
            <div class="container ">
                <div class="row d-flex justify-content-center">
                    @include("theme.alert")

                    <table class="table table-striped" id="Usuarios" width="99%">
                        <thead>
                            <tr>
                                <th scope="col" class="align-middle">Id</th>
                                <th scope="col" class="align-middle">Nombre de Ususario</th>
                                <th scope="col" class="align-middle">Tipo de Usuario</th>
                                <th scope="col" class="align-middle">Acciones</th>
                            </tr>
                        </thead>
                        @foreach ($usuarios as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->type }}</td>
                                <td>
                                    {{-- EDITAR --}}
                                    <a type="button" class="btn btn-warning btn-sm"
                                        href="{{ route('Usuario.edit', $user->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                        Editar
                                    </a>
                                    {{-- ELIMINAR --}}
                                    <form action="{{ route('Usuario.destroy', $user->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    {{-- Tiempo de vida de la alerta --}}
    <script>
        $(function() {
            setTimeout(() => {
                $(".alert").remove();
            }, 4000);
        });
    </script>
    {{-- Tabla --}}
    <script>
        $(document).ready(function() {
            $('#Usuarios').DataTable({

                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar " +
                        `<select>
                    <option value = "5">5</option>
                    <option value = "10">10</option>
                    <option value = "15">25</option>
                    <option value = "50">50</option>
                    <option value = "-1">All</option>
                    </select>` +
                        " registros por página",
                    "zeroRecords": "Sin resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sin registros",
                    "infoFiltered": "(Filtrando de _MAX_ registros totales)",
                    'search': 'Buscar',
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }

            });
        });
    </script>

@endsection
