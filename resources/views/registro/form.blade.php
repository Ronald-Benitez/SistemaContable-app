
@extends('theme.base')

@section('content')
    <div class="container py-5">
        <h1 class="text-center">Ingresar partida</h1>
 
        <form action="{{ route('Registro.store') }}" method="post">
            @csrf

            <table class="table table-responsive " id="tabla">
                <tr class="fila-fija">
                    <td><input type="datetime" required value="{{$now}}" class="form-control" readonly></td>
                    <td>
                        <select class="form-select idC" aria-label="Default select example" name="idCuenta[]" onchange="balance()">
                            <option selected value="">Cuenta</option>
                            @foreach($cuentas as $cuenta)
                            <option value="{{$cuenta->idC}}">{{$cuenta->nombre}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="monto[]" min="0.00" step="0.01" placeholder="monto ($)" class="form-control monto" onkeyup="balance()"></td>
                    <td>
                        <select class="form-select tipo" aria-label="Default select example" onchange="balance()" name="tipoM[]">
                            <option selected value="1">Tipo</option>
                            <option value="1">Cargo</option>
                            <option value="2">Abono</option>
                        </select>
                    </td>
                    <td class="eliminar"><input type="button" value="-" class="btn btn-danger" ></td>
                </tr>
            </table>
            <div class="btn-group p-4">
                <input id="insertar" type="submit" value="Registrar" class="btn btn-info">
                <button id="adicional" class="btn btn-warning">Nueva fila</button>
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
        $(function(){
            $("#adicional").click(function(){
                $("#tabla tbody tr:eq(0)").clone().removeClass("fila-fija").appendTo("#tabla");
            });
            $(document).on("click",".eliminar",function(){
                let parent = $(this).parents().get(0);
                if(!$(parent).hasClass("fila-fija")){
                    $(parent).remove();
                }
                
                balance()
            });
            $(document).on("click","#adicional",function(){
                event.preventDefault();
            })

            $(document).on("click","#insertar",function(){
                if($("#debe").val()!=$("#haber").val()){
                    alert("La partida no cuadra")
                    event.preventDefault();
                }
                console.log($("#debe").val())
                console.log($("#haber").val())
                
                verificar()
            })

            
        });

        function balance(){
                let montos = document.querySelectorAll(".monto");
                let tipo = document.querySelectorAll(".tipo");
                let debe=0;
                let haber=0;
                let aux=0;

                montos.forEach(function(item,index){
                    
                    if(tipo[index].value==1){
                        aux=parseInt(item.value,10)
                        if(aux>=0){
                            debe+=aux
                        }
                    }else{
                        aux=parseInt(item.value,10)
                        if(aux>=0){
                            haber+=aux
                        }
                    }
                })
                $("#debe").val(debe)
                $("#haber").val(haber)

                if(debe>haber||haber>debe){
                    $(".balance").css('background-color', 'red')
                }else{
                    $(".balance").css('background-color', 'green')
                }
                $(".balance").css('color', 'white')
        }

        function verificar(){
            let cuentas = document.querySelectorAll(".idC")

            cuentas.forEach(function(item){
                console.log(item.value)
                if(item.value==""){
                    alert("Cuenta sin seleccionar")
                    event.preventDefault();
                }
            })
        }
    </script>
@endsection