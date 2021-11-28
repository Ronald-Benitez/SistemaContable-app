@extends('theme.base')

@section('content')
    <div class="container mt-3 py-5">

        @if (isset($partida))
            <h1 class="text-center">Actualizar partida</h1>
            <form action="{{ route('Registro.update', $partida) }}" method="post">
                @method('PUT')
            @else
                <h1 class="text-center">Ingresar partida</h1>
                <form action="{{ route('Registro.store') }}" method="post">
        @endif

        @csrf

        <table class="table table-responsive " id="tabla">
            @if (isset($partida))
                @foreach ($registros as $registro)
                    <tr>
                        <input type="text" class="invisible" name="id[]" value="{{ $registro->id }}">
                        <td><input type="datetime" required value="{{ $registro->created_at }}" class="form-control"
                                readonly></td>
                        <td>
                            <select class="form-select idC" aria-label="Default select example" name="idCuenta[]"
                                onchange="balance()">
                                <option selected value="{{ $registro->idC }}">{{ $registro->nombre }}</option>
                                @foreach ($cuentas as $cuenta)
                                    <option value="{{ $cuenta->idC }}">{{ $cuenta->nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="monto[]" min="0.00" step="0.01" placeholder="monto ($)"
                                class="form-control monto" onkeyup="balance()" value="{{ $registro->monto }}" </td>
                        <td>
                            <select class="form-select tipo" aria-label="Default select example" onchange="balance()"
                                name="tipoM[]">
                                <option selected value="{{ $registro->tipoM }}">Tipo</option>
                                <option value="1">Cargo</option>
                                <option value="2">Abono</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="fila-fija">
                    <td><input type="datetime" required value="{{ $now }}" class="form-control" readonly></td>
                    <td>
                        <select class="form-select idC" aria-label="Default select example" name="idCuenta[]"
                            onchange="balance()">
                            <option selected value="">Cuenta</option>
                            @foreach ($cuentas as $cuenta)
                                <option value="{{ $cuenta->idC }}">{{ $cuenta->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="monto[]" min="0.00" step="0.01" placeholder="monto ($)"
                            class="form-control monto" onkeyup="balance()"></td>
                    <td>
                        <select class="form-select tipo" aria-label="Default select example" onchange="balance()"
                            name="tipoM[]">
                            <option selected value="1">Tipo</option>
                            <option value="1">Cargo</option>
                            <option value="2">Abono</option>
                        </select>
                    </td>
                    <td class="eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </td>
                </tr>
            @endif
        </table>
        @if (isset($partida))
            <label for="" class="form-label">Concepto</label>
            <textarea name="concepto" cols="30" rows="2" class="form-control" required>{{ $concepto }}</textarea>
        @else
            <label for="" class="form-label">Concepto</label>
            <textarea name="concepto" cols="30" rows="2" class="form-control" required></textarea>
        @endif
        <div class="btn-group p-4">
            @if (isset($partida))
                <input id="insertar" type="submit" value="Actualizar" class="btn btn-info">
                <a href="{{ route('Registro.index') }}" class="btn btn-warning">Cancelar</a>
            @else
                <input id="insertar" type="submit" value="Registrar" class="btn btn-info">
                <button id="adicional" class="btn btn-warning">Nueva fila</button>
                <a href="{{ route('Registro.index') }}" class="btn btn-warning">Cancelar</a>
            @endif

        </div>
        </form>
        <div class="container">
            <div class="input-group">
                <span class="input-group-text">Debe</span>
                <input type="text" readonly class="form-control balance" id="debe">
                <span class="input-group-text">Haber</span>
                <input type="text" readonly class="form-control balance" id="haber">
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            balance();
            $("#adicional").click(function() {
                $("#tabla tbody tr:eq(0)").clone().removeClass("fila-fija").appendTo("#tabla");
            });
            $(document).on("click", ".eliminar", function() {
                let parent = $(this).parents().get(0);
                if (!$(parent).hasClass("fila-fija")) {
                    $(parent).remove();
                }

                balance()
            });
            $(document).on("click", "#adicional", function() {
                event.preventDefault();
            })

            $(document).on("click", "#insertar", function() {
                if ($("#debe").val() != $("#haber").val()) {
                    alert("La partida no cuadra")
                    event.preventDefault();
                }
                console.log($("#debe").val())
                console.log($("#haber").val())

                verificar()
            })


        });

        function balance() {
            let montos = document.querySelectorAll(".monto");
            let tipo = document.querySelectorAll(".tipo");
            let debe = 0;
            let haber = 0;
            let aux = 0;

            montos.forEach(function(item, index) {

                if (tipo[index].value == 1) {
                    aux = parseFloat(item.value);
                    if (aux >= 0) {
                        debe += aux
                    }
                } else {
                    aux = parseFloat(item.value);
                    if (aux >= 0) {
                        haber += aux
                    }
                }
            })
            debe = debe.toFixed(2)
            haber = haber.toFixed(2)
            $("#debe").val(debe)
            $("#haber").val(haber)

            if (debe > haber || haber > debe) {
                $(".balance").css('background-color', 'red')
            } else {
                $(".balance").css('background-color', 'green')
            }
            $(".balance").css('color', 'white')
        }

        function verificar() {
            let cuentas = document.querySelectorAll(".idC")

            cuentas.forEach(function(item) {
                console.log(item.value)
                if (item.value == "") {
                    alert("Cuenta sin seleccionar")
                    event.preventDefault();
                }
            })
        }
    </script>
@endsection
