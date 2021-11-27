@extends('theme.base')

@section('content')

<div class="container">
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

    <form action="{{route('Costos.update',$registro)}}" method="POST">
        @csrf
        @method('put')
        {{-- concepto --}}
        <label for="nombre" class="form-label">Concepto</label>
        <input type="text" name="costoName" id="nombre" value="{{$registro->costoName}}" class="form-control">
    
        
        {{-- monto --}}
        <label for="nombre" class="form-label">Monto</label>
        <input type="number" name="monto" min="0.00 " step="0.01" value="{{$registro->monto}}" id="nombre" class="form-control">
       
    
        {{-- Tipo --}}
        <label for="nombre" class="form-label">Tipo</label>    
        <select class="form-select" name="type" id="tupoMonto">
            @php
                $options = array( 'MD:  Material directo',
                            'MOD: Mano de obra directa',
                            'CIF',
                            'Periodo');
                $values= array('MD','MOD','CIF','Periodo');
                $output = '';
                for( $i=0; $i<count($options); $i++ ) {
                $output .= '<option ' 
                            . ( $registro->type == $values[$i] ? 'selected="selected"' : '' ) .
                            ' value="'.$values[$i].'">' 
                            . $options[$i] 
                            . '</option>';
                }
                echo $output;
            @endphp
            {{-- <option selected value>-- Tipo de costo --</option>
            <option value="MD">MD:  Material directo</option>
            <option value="MOD">MOD: Mano de obra directa</option>
            <option value="CIF">CIF</option>
            <option value="Periodo">Perdiodo</option> --}}
        </select>
        <input type="text" name="LCostos_id" value="{{$registro->LCostos_id}}" class="invisible">
        <input type="text" name="id" value="{{$registro->id}}" class="invisible">
    
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <input type="submit" class="btn btn-primary" value="Agregar nuevo"></input>
          </div>
      </form>
    {{-- FIN FORMULARIO --}}
</div>

@endsection

@section('script')
<script>
    setTimeout(() => {
        $(".mensaje").remove();
    }, 4000);
</script>
@endsection