<div class="modal fade" id="datos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Datos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="invisible" id="ctp">{{$sum['MD']+$sum['MOD']+$sum['CIF']}}</div>
            <table class="table" id="tablaCostos">
                <tbody>
                    <tr>
                        <td>CTP</td>
                        <td>$ {{number_format($sum['MD']+$sum['MOD']+$sum['CIF'],2)}}</td>
                    </tr>
                    <tr>
                        <td>CC</td>
                        <td>$ {{ number_format(($sum['MD']+$sum['CIF']),2) }}</td>
                    </tr>
                    <tr>
                        <td>CP</td>
                        <td>$ {{ number_format(($sum['MD']+$sum['MOD']),2) }}</td>
                    </tr>
                    <tr>
                        <td>Costo de periodo</td>
                        <td>$ {{ number_format($sum['Periodo'],2)}}</td>
                    </tr>
                    <tr>
                        <td>Cantidad de Productos</td>
                        <td><input class="input" min="1" step="1" type="number" id="cProduct"></td>
                    </tr>
                    <tr>
                        <td>% de ganacias</td>
                        <td><input type="number" min="0" id="ganacias"></td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <td>Costo unitario</td>
                        <td id="costoU">$0.00</td>
                    </tr>
                    <tr>
                        <td>Precio Unitario</td>
                        <td><div id="precioU">$0.00</div></td>
                    </tr>
                    <tr>
                        <td>Precio Unitario + IVA</td>
                        <td id="precioIVA">$0.00</td>
                    </tr>
                </tfoot>
            </table>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
               
      </div>
    </div>
  </div>