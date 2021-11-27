  <div class="modal fade" id="agregarCosto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo Registro de costo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- FORMULARIO --}}
          <form action="{{route('Costos.store')}}" method="POST">
            @csrf
            {{-- concepto --}}
            <label for="nombre" class="form-label">Concepto</label>
            <input type="text" name="costoName" id="nombre" value="{{old('costoName')}}" class="form-control">

            
            {{-- monto --}}
            <label for="nombre" class="form-label">Monto</label>
            <input type="number" name="monto" min="0.00 " step="0.01" value="{{old('monto')}}" id="nombre" class="form-control">
           

            {{-- Tipo --}}
            <label for="nombre" class="form-label">Tipo</label>

            <select class="form-select" name="type" id="tupoMonto">
                <option selected value>-- Tipo de costo --</option>
                <option value="MD">MD:  Material directo</option>
                <option value="MOD">MOD: Mano de obra directa</option>
                <option value="CIF">CIF</option>
                <option value="Periodo">Perdiodo</option>
            </select>
            <input type="text" name="LCostos_id" value="{{$id}}" class="invisible">

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-primary" value="Agregar nuevo"></input>
              </div>
          </form>
        {{-- FIN FORMULARIO --}}
        </div>       
      </div>
    </div>
  </div>