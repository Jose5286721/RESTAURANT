
  <div class="modal fade bd-example" id="cancelar_pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Cancelar pedido</h4>
        </div>
        <div class="modal-body">

          <form method="post">
          <div class="row">
            <div class="col-md-12">  
              <div class="form-group">
               <center>¿Está seguro que desea <b>CANCELAR</b> el pedido de la <b>MESA <span class="nro_mesa"></span></b>? </label>
              </div>
            </div>

          </div>
         <input type="hidden" id="tabla_cancelar" name="tabla_cancelar" value="">
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" name="cancelarMesas">Cancelar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>