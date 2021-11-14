
@extends('theme.base')

@section('content')
    <div class="container py-5">
        <h1 class="text-center">Libro diario</h1>
        <a href="{{ route('Registro.create')}}" class="btn btn-secondary">Nueva partida</a>

        <?php 
            $partida =0; 
            $fecha =0;
        ?>
        <table class="table">
            <thead>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Debe</th>
                <th>Haber</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($registros as $registro)
                @if($partida!=$registro->partida)
                <tr>
                    <td>{{$registro->created_at}}</td>
                    <td><b>Px{{$registro->partida}}</b></td>
                    <td></td>
                    <td></td>
                    <td>Editar-eliminar</td>
                </tr>
                <?php 
                    $partida=$registro->partida; 
                    $fecha=$registro->created_at;
                ?>
                @endif
                    
                <tr>
                    
                    <td></td>
                    <td>{{$registro->nombre}}</td>
                    @if ($registro->tipoM ==1)
                        <td class="debe">{{$registro->monto}}</td>
                        <td class="haber"></td>
                    @else
                        <td class="debe"></td>
                        <td class="haber">{{$registro->monto}}</td>
                    @endif
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
            let debe = document.querySelectorAll(".debe");
            let haber = document.querySelectorAll(".haber");
            let sDebe=0;
            let sHaber=0;

            debe.forEach(function(item){
                if(item.innerHTML!=""){
                    sDebe+=parseFloat(item.innerHTML);(item.innerHTML,10)
                }
            })
            haber.forEach(function(item){
                if(item.innerHTML!=""){
                    sHaber+=parseFloat(item.innerHTML);(item.innerHTML,10)
                }
            })

            $("#debe").val(sDebe)
            $("#haber").val(sHaber)
        });
    </script>

@endsection