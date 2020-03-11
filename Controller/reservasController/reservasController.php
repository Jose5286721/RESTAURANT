<?php  
ob_start();

class MvcController {

   public function plantilla(){
   	     include 'Views/template.php';
   }

  	#INTERACCIÓN DEL USUARIO
	#----------------------------------------------
	public function enlacesPaginasController(){

		if(isset($_GET["action"])){

		  $enlacesController = $_GET["action"];

		}else{

		   $enlacesController = "index";
			
		}
      // le pide al modelo y que conecte con :: al método y asi heredo la clase y sus metodos y atributos..
		 $respuesta = Paginas::enlacesPaginasModel($enlacesController);
		 require $respuesta;

	}
	//=============================================================================
	//RESERVAS
	//============================================================================
// funcion para devolver todas las reservas.
	 	public function getReservasController(){

	 		date_default_timezone_set('America/Argentina/Buenos_Aires');
	 		$hoy = date('Y-m-d');
 		$respuesta = Datos::getReservasModel('reservas');
 			# code...
 		foreach ($respuesta as $row) {
 			if ($hoy == $row['diallegada']) {
	 			echo '<tr>			
					<td align="center"> '.$row["nombrecliente"].'</td>
					<td align="center"> '.$row["cantidadpersonas"].'</td>
					<td align="center"> '.$row["idmesa"].'</td>
					<td align="center">'.$row["telefono"].'</td> 
				  <td align="center">'.date("d-m-Y", strtotime($row["diallegada"])).'</td>
					<td align="center">'.date("H:i",strtotime($row["horallegada"]))." - ".date("H:i",strtotime($row["horasalida"])).'</td>
					<td align="center">'.$row["observaciones"].'</td>		
					<td align="center"><a href="index.php?action=editarReservas&idreserva='.$row["idreserva"].'"<i class="fa fa-edit btn btn-primary btn-sm"></i></a>&nbsp;&nbsp;&nbsp;
					    <a href="index.php?action=reservas&idBorrar='.$row["idreserva"].'"<i class="fa fa-trash-o btn btn-danger btn-sm"></i></a>
					</td>
				    </tr>';
 			}
 		}
 		}
 	//insertar reservas
 	public function agregarReservaController(){
         	if(isset($_POST['agregar'])) {
			$arrayAux = $_POST['numeromesa'];
			$horas = $_POST['horas'];
			$cantidadPersonas = $_POST['cantidadpersonas'];
			$largoArray = sizeof($_POST['numeromesa']);
			$arrayDePersonas = array();
			if($largoArray>1){
				if($cantidadPersonas % $largoArray == 0 ){
					$cantidadPeronasPorMesa = $cantidadPersonas/$largoArray;
					for($cont = 0; $cont<$largoArray; $cont++){
						array_push($arrayDePersonas,$cantidadPeronasPorMesa);
					}
				}else{
					$resto = $cantidadPersonas % $largoArray;
					$cantidadPeronasPorMesa = intdiv($cantidadPersonas,$largoArray);
					for($cont = 0; $cont<$largoArray; $cont++){
						if($cont == $largoArray-1){
							array_push($arrayDePersonas,$cantidadPeronasPorMesa+$resto);
						}else{
							array_push($arrayDePersonas,$cantidadPeronasPorMesa);
						}
					}
				}
			}else{
				array_push($arrayDePersonas,$cantidadPersonas);
			}
			for($contador = 0; $contador<$largoArray;$contador++){
				$arrayAux[$contador];
				$datosController = array("nombrecliente"=>$_POST['nombrecliente'],
 				                     "cantidadpersonas"=>$arrayDePersonas[$contador],
 				                      "telefono"=>$_POST['telefono'],
 				                      "diallegada"=>$_POST['diallegada'],	              
									   "horallegada"=>$horas[0],	 
									   "horasalida"=>$horas[1],            
									   "observaciones"=>$_POST['observaciones'],
									   "idmesa"=>$arrayAux[$contador] //$_POST['numeromesa']         
									  );
				$respuesta= Datos::agregarReservasModel($datosController,'reservas');
			}
			$arrayDePersonas = array(); 
			/*$datosController = array("nombrecliente"=>$_POST['nombrecliente'],
 				                     "cantidadpersonas"=>$_POST['cantidadpersonas'],
 				                      "telefono"=>$_POST['telefono'],
 				                      "diallegada"=>$_POST['diallegada'],	              
 				                      "horallegada"=>$_POST['horallegada'],	              
									   "observaciones"=>$_POST['observaciones'],
									   "idmesa"=>$_POST['numeromesa']
 				                                  
 				                     );*/
 			#pedir la informacion al modelo.
 		
 		//$respuesta= Datos::agregarReservasModel($datosController,'reservas');
 			if ($respuesta == 'success') {
 				header('location:okReservas');
 			}else{
                header('location:reservas');
			 }
			 
 		}
 	}

 	//borrar Reservas
   public function deleteReservasController(){
   	 if (isset($_GET['idBorrar'])) {
   	 	$datosController = $_GET['idBorrar'];

   	 	$respuesta = Datos::deleteReservaModel($datosController,'reservas');
   	 	if ($respuesta == 'success') {
         header('location:borrarReservas');
          
   	 	}
   	 }
   }
//cantidad de reservas
   public function totalReservasController(){
   	  $respuesta = Datos::totalReservasModel('reservas');
   	 	foreach ($respuesta as $key ) {
 			 echo $key['total'];
 		}
   	  	
   	  
   }

     public function editarReservasController(){
      	$datosController= $_GET['idreserva'];
	    $respuesta =Datos::editarReservasModel($datosController, 'reservas');

	    echo ' <form method="post">
          <div class="row">
            <div class="col-md-6">  
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Nombre Cliente:</label>
                <input type="text" class="form-control" id="recipient-name" name="nombrecliente" value="'.$respuesta['nombrecliente'].'">
              </div>
            </div>
               <div class="col-md-6">  
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Cantidad de Personas:</label>
              <input type="text" class="form-control" id="recipient-name" name="cantidadpersonas" value="'.$respuesta['cantidadpersonas'].'">
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6"> 
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Telefono de Contacto:</label>
              <input type="text" class="form-control" id="recipient-name" name="telefono"  value="'.$respuesta['telefono'].'">
            </div>
            </div>
            <div class="col-md-6"> 
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Fecha Reserva (1/10/2017):</label>
              <input type="text" id="datepicker" class="form-control" id="recipient-name" name="diallegada" value="'.$respuesta['diallegada'].'">
            </div>
            </div>
            </div>
             <div class="row">
                <div class="col-md-3"> 
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Desde (22:00):</label>
              <input type="time" class="form-control" id="recipient-name" name="horas[]" value="'.$respuesta['horallegada'].'">
            </div>
			</div>
			<div class="col-md-3"> 
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Hasta (22:00):</label>
              <input type="time" class="form-control" id="recipient-name" name="horas[]" value="'.$respuesta['horasalida'].'">
            </div>
            </div>
              <div class="col-md-6"> 
              <div class="form-group">
              <label for="message-text" class="form-control-label">Observaciones:</label>
              <textarea class="form-control" id="message-text" name="observaciones" required="">'.$respuesta['observaciones'].'</textarea>
            </div>
            </div>
        </div>
        </div>
        <input type="hidden" name="idreserva" value="'.$respuesta['idreserva'].'">
          <button type="submit" class="btn btn-primary form-control" name="editar">Agregar Reserva</button>
          </form>';
     
    }

    public function actualizarReservasController(){
    	if (isset($_POST['editar'])) {
			$horas = $_POST['horas'];
    		$datosController=array('nombrecliente'=>$_POST['nombrecliente'],
    			                   'cantidadpersonas'=>$_POST['cantidadpersonas'],
    			                   'telefono'=>$_POST['telefono'],
    			                   'diallegada'=>date("Y-m-d", strtotime($_POST['diallegada'])),
								   'horallegada'=>$horas[0],
								   'horasalida'=>$horas[1],
    			                   'observaciones'=>$_POST['observaciones'],
    			                   'idreserva'=>$_POST['idreserva']
    			);
    	$respuesta=Datos::actualizarReservasModel($datosController,'reservas');	
    	  	if ($respuesta == 'success') {
      				  header('location:cambioReservas');
      		}
    	}
    }
   //=============================================================================
	//FIN DE RESERVAS
	//============================================================================

	//=============================================================================
	//MESAS
	//============================================================================
	//Obtiene todas las mesas disponibles


	public function getMesasDisponiblesController($fechaOpcion){
		$mesasOcupadas = Datos::getMesasDisponiblesParaReservar($fechaOpcion);
		$mesasTotales = Datos::getMesas();
      	$mesasParaReservar = array();
      	foreach($mesasTotales as $mesas){
         $aux = $mesas['nombremesa'];
         foreach($mesasOcupadas as $total){
            $aux1 = $total['nombremesa'];
            if($aux == $aux1){
				unset($mesas);
            }
		 }	
		 if(isset($mesas)){
			array_push($mesasParaReservar, $mesas);
		 }
		}
   	 	foreach ($mesasParaReservar as $mesa){
 			 echo "<option value='".$mesa['idmesa']."'>".$mesa['nombremesa']."</option>";
 		}
	}


	//=============================================================================
	//FIN DE MESAS
	//============================================================================
	
}
