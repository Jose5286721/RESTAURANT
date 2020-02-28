
  <div class="modal fade bd-example" id="entregar_pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Entregar pedido</h4>
        </div>
        <div class="modal-body">

          <form method="post">
          <div class="row">
            <div class="col-md-12">  
              <div class="form-group">
               <center>¿Está seguro que desea <b>ENTREGAR</b> el pedido de la <b>MESA <span id="nro_mesa_entrega" class="nro_mesa"></span></b> ?</label>
              </div>
            </div>

          </div>
         <input type="hidden" id="tabla_entregar" name="tabla_entregar" value="">
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <!-- <button type="submit" class="btn btn-primary btn-entregar" name="entregarMesas">Entregar e imprimir</button> -->
          <button type="button" class="btn btn-primary btn-entregar" >Entregar e imprimir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('.btn-entregar').on('click', function() {
      myWindow = window.open('Views/modules/ventas/reportes/ticket_mesa_cliente.php?mesa=mesa'+$("#nro_mesa_entrega").text(),'ticket','width=1000,height=550,scrollbars=1,menubar=yes,toolbar=yes')
      myWindow.focus();
  })
</script>
