
  <div class="modal fade bd-example-modal-lg" id="reserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel">Nueva Reserva</h4>
        </div>
        <div class="modal-body">

          <form method="post">
          <div class="row">
            <div class="col-md-6">  
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Nombre Cliente:</label>
                <input type="text" class="form-control" id="recipient-name" name="nombrecliente" required="">
              </div>
            </div>
               <div class="col-md-6">  
             <div class="form-group">
              <label for="cantidadPersonas" class="form-control-label">Cantidad de Personas:</label>
              <input type="text" class="form-control" id="cantidadPersonas" name="cantidadpersonas" required="">
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6"> 
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Telefono de Contacto:</label>
              <input type="text" class="form-control" id="recipient-name" name="telefono" required="">
            </div>
            </div>
            <div class="col-md-6"> 
             <div class="form-group">
              <label for="FechaReserva" class="form-control-label">Fecha Reserva (1/10/2017):</label>
              <input type="date" min="<?php $hoy=date("Y-m-d"); echo $hoy;?>" class="form-control" id="FechaReserva" name="diallegada" required="">
            </div>
            </div>
            </div>
             <div class="row">
              <div class="col-md-3"> 
              <div class="form-group">
              <label for="horallegada" class="form-control-label">Desde: (22:00):</label>
              <input type="time" class="form-control" id="horallegada" name="horas[]" required="">
            </div>
            </div>
            <div class="col-md-3"> 
              <div class="form-group">
              <label for="horasalida" class="form-control-label">Hasta: (22:00):</label>
              <input type="time" class="form-control" id="horasalida" name="horas[]" required="">
            </div>
            </div>
              <div class="col-md-6"> 
              <div class="form-group">
              <label for="message-text" class="form-control-label">Observaciones:</label>
              <textarea class="form-control" id="message-text" name="observaciones" required="">Sin Restricciones</textarea>
            </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6"> 
             <div class="form-group">
              <label for="NroMesas" class="form-control-label">Numero de mesa :</label>
              <select class="form-control" id="NroMesas" name="numeromesa[]" multiple="multiple" required="">
                <?php 
                  $fecha = array("fechaOpcion"=>date('Y-m-d'),"horallegada"=>"00:00","horasalida"=>"00:00");
                  $mesa = new MvcController();
                  $mesa->getMesasDisponiblesController($fecha);
                ?>
              </select>
            </div>
            </div>
              <div class="col-md-6"></div>
              </div>
            <input type="hidden" name="idusuario" value="<?php echo $_SESSION['nombreusuario']; ?>">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="agregar">Agregar Reserva</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--<script>
  const fecha = document.getElementById('FechaReserva');
  fecha.addEventListener('change',(event)=>{
    event.preventDefault();
    var response;
    var request = new XMLHttpRequest();
    request.open('GET','http://localhost/RESTAURANT/Views/reservas/api/Mesas.php?fechaOpcion='+event.target.value,true);
    request.onreadystatechange = (e)=>{
        if(request.readyState == 4){
            if(request.status == 200){
                response = request.response;
                console.log(response);
            }
        }
    }
    request.send();
    });
</script>-->
<?php  
$registrar = new MvcController();
$registrar->agregarReservaController();
?>