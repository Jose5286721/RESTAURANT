<?php  
	require 'Views/modules/ventas/conexion.php';	
ob_start();

 	$tabla = $_GET['action'];
 // echo $tabla;
 // echo $id;
  	if (isset($_GET['idmesa'])) {
       $id = $_GET['idmesa']; 
   	 	
   	 	$sql = $conexion->prepare("DELETE FROM $tabla WHERE idmesa = $id");
   	 	$sql->execute();
   	 	 header("location:$tabla");
	}
	 	
	//AGREGAR PEDIDOS NUEVOS
	if (isset($_POST['agregarBebidas'])) {
 		date_default_timezone_set('America/Argentina/Buenos_Aires');
 		$fecha = $_POST['fecha'];
 		// echo $fecha;
 		$usu = $_POST['usuario'];
 		$producto = $_POST['producto'];
		 
		foreach($producto as $key) {
			list($idproducto,$precio) = explode('-' , $key);	 
			// echo "id es : ".  $idproducto.'<br>';
			// echo "el precio es:".$precio;	 
			$sql = $conexion->prepare("INSERT INTO $tabla (idproducto, idusuario, fecha, precio, precio_total_producto)
									  VALUES (:idproducto, :idusuario, :fecha, :precio, :precio)");
			$sql->execute(array(':idproducto'=>$idproducto,
								':idusuario'=>$usu,					
								':fecha'=>$fecha,
								':precio'=>$precio,
								':precio'=>$precio));
 		}	
        header("location:$tabla");
	 }
	 
	 //ACTUALIZAR CANTIDADES DE LOS PEDIDOS
	 if (isset($_POST['cantidadProducto'])) {
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$idmesa = $_POST['idmesa'];
		// echo $fecha;
		// $usu = $_POST['usuario'];
		// $producto = $_POST['producto'];
		
	   foreach($idmesa as $key) {
			$sql= Conexion::conectar()->prepare("UPDATE $tabla SET idproducto = :idproducto, 
																   idusuario = :idusuario, 
																   precio = :precio,
																   cantidad = :cantidad, 
																   precio_total_producto = :precio_total_producto 
												WHERE idmesa = idmesa");

			$sql->bindParam(':idproducto',$key['idproducto'], PDO::PARAM_INT);
			$sql->bindParam(':idusuario',$key['idusuario'], PDO::PARAM_INT);
			// $sql->bindParam(':fecha',$tabla['idusuario'], PDO::PARAM_INT);
			$sql->bindParam(':precio',$key['precio'], PDO::PARAM_INT);
			$sql->bindParam(':cantidad',$key['cantidad'], PDO::PARAM_INT);
			$sql->bindParam(':precio_total_producto',$key['precio_total_producto'], PDO::PARAM_INT);

			if($sql->execute()){
			return "success";
			//alert("COMIENZA A ACUTALIZAR");
			}else{
			return  "error";
			//alert("NO ANDA TU MIERDA");
			}
			$sql->close();
		}	
	   header("location:$tabla");
	}


	//FINALIZAR VENTA
	if (isset($_POST['venta'])) {
		$sql=$conexion->prepare("INSERT INTO detalles (idproducto, idusuario, fecha, mesa, cantidad, precio, precio_total_producto)
						         SELECT ta.idproducto, ta.idusuario, ta.fecha, ta.mesa, ta.cantidad, ta.precio, ta.precio_total_producto
								 FROM $tabla ta");
		$sql->execute();
		$sql = $conexion->prepare("DELETE FROM $tabla");
		$sql->execute();
		
		header("location:$tabla");
	}
 ?>

 <div class="container" style="overflow: auto; width: 720px; height: 1000px; display: none !important" id="prueba">		<!-- CUADRO_TICKET -->
	<center><h1><i class="fa fa-table" aria-hidden="true"> </i> <?php echo strtoupper($tabla); ?></h1>	

	<?php   $consult = $conexion->query("SELECT * FROM $tabla ta JOIN productos pro ON ta.idproducto = pro.idproducto
																JOIN estados_productos EP ON ta.id_estado_producto = EP.id_estado_producto  ");  ?>
	
	<table class="table table-bordered" id="imprimeme">
		<thead>
			<tr>	    	      
			<th colspan="2" style="text-align:center">PRODUCTO</th>
			<th colspan="3" style="text-align:center">PRECIO UNIT.</th>
			<th style="text-align:center">CANT.</th>
			<th style="text-align:center">TOTAL</th>
			
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($consult as $key): ?>
				<tr>            
					<td colspan="2"><?php echo $key['nombreproducto'] ?></td>		  		  
					<td colspan="3" style="text-align:right"><i class="fa fa-usd"> </i> <input type='text' readonly="readonly" disabled="disabled" style="text-align:right;width:100px;border:none;background-color: white;" id='precioUnitario' value='<?php echo $key['precio'] ?>' onchange="calcularTotal()"></td>
					<td><input type='number' style="text-align:right; width:50px" readonly="readonly" disabled="disabled" id='cantidadProducto' min="1" value='<?php echo $key['cantidad']?>' onchange="calcularTotal();"></td>
					<td><input type="text" id="totalProducto" readonly="readonly" disabled="disabled" style="text-align:right;width:100px;border:none;background-color: white;" value='<?php echo  $key['precio'] * $key['cantidad']?>' ></td>	

				</tr>  	    
						
			<?php endforeach ?>
				<tr>
					<!-- <th scope="row" style="text-align:right" colspan="2"><i class="fa fa-usd ; width:60px "></i></th> -->
					<th scope="row" style="text-align:right" colspan="2"></th>
					<td colspan="4" style="text-align:right">TOTAL GENERAL</td>
					<?php  
						$total = $conexion->prepare("SELECT  SUM(precio_total_producto) AS TOTAL FROM $tabla");
						$total->execute();
					foreach ($total as $key) {
					$result = number_format($key['TOTAL'], 0,'','.');
					} ?>
					<td style="text-align:right"><?php echo $result; ?><i class="fa fa-usd"></i></td>
				</tr>
		</tbody>
	</table>

	<?php 
	$sql=$conexion->prepare("SELECT * FROM $tabla,usuarios ");
	$sql->execute();
	?>
		<form method="post">
		<?php foreach ($sql as $key) :?>
			<input type="hidden" name="fecha[]" value="<?php echo date("Y-m-d"); ?>">
			<input type="hidden" name="idproducto[]" value="<?php echo $key['idproducto'] ?>">
			<input type="hidden" name="precio[]" value="<?php echo $key['precio'] ?>">
			<input type="hidden" name="idusuario[]" value="<?php echo $key['idusuario'] ?>">
		<?php endforeach; ?>  		
		</form> 
</div>

<div class="container" style="overflow: auto; width: 720px; height: 1000px;">		<!-- CUADRO_MESA -->
	<center><h1><i class="fa fa-table" aria-hidden="true"> </i> <?php echo strtoupper($tabla); ?></h1>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bebidas" data-whatever="@mdo">
		<i class="fa fa-plus-square"> </i> ADICIONAR PEDIDOS </button></center>
		
	<?php require 'Views/modal/modal_agregar_productos.php'; ?>

	<?php   $consult = $conexion->query("SELECT * FROM $tabla ta JOIN productos pro ON ta.idproducto = pro.idproducto
																JOIN estados_productos EP ON ta.id_estado_producto = EP.id_estado_producto  ");  ?>
	
	<table class="table table-bordered" id="imprimeme">
		<thead>
			<tr>	    	      
			<th colspan="2" style="text-align:center">PRODUCTO</th>
			<th colspan="3" style="text-align:center">PRECIO UNIT.</th>
			<th style="text-align:center">CANT.</th>
			<th style="text-align:center">TOTAL</th>
			<th colspan="3" style="text-align:center">ESTADO</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($consult as $key): ?>
				<tr>            
					<td colspan="2"><?php echo $key['nombreproducto'] ?></td>		  		  
					<td colspan="3" style="text-align:right"><i class="fa fa-usd"> </i> <input type='text' readonly="readonly" disabled="disabled" style="text-align:right;width:100px;border:none;background-color: white;" id='precioUnitario' value='<?php echo $key['precio'] ?>' onchange="calcularTotal()"></td>
					<td><input type='number' style="text-align:right; width:50px" readonly="readonly" disabled="disabled" id='cantidadProducto' min="1" value='<?php echo $key['cantidad']?>' onchange="calcularTotal();"></td>
					<td><input type="text" id="totalProducto" readonly="readonly" disabled="disabled" style="text-align:right;width:100px;border:none;background-color: white;" value='<?php echo  $key['precio'] * $key['cantidad']?>' ></td>	
					<td> <?php if($key['id_estado_producto'] == "1"){  
									echo $key['estado'];															
								} elseif($key['id_estado_producto'] == "2"){ 
									echo $key['estado']; 
								} ?> 
								<a href="index.php?action=<?php echo $tabla ?>&idmesa=<?php echo $key['idmesa']  ?>" class="pull-right" >
								<i class="fa fa-trash-o btn btn-danger btn-sm"></i></a></td>
				</tr>  	    
						
			<?php endforeach ?>
				<tr>
					<!-- <th scope="row" style="text-align:right" colspan="2"><i class="fa fa-usd ; width:60px "></i></th> -->
					<th scope="row" style="text-align:right" colspan="2"></th>
					<td colspan="4" style="text-align:right">TOTAL GENERAL</td>
					<?php  
						$total = $conexion->prepare("SELECT  SUM(precio_total_producto) AS TOTAL FROM $tabla");
						$total->execute();
					foreach ($total as $key) {
					$result = number_format($key['TOTAL'], 0,'','.');
					} ?>
					<td style="text-align:right"><?php echo $result; ?><i class="fa fa-usd"></i></td>
				</tr>
		</tbody>
	</table>

	<?php 
	$sql=$conexion->prepare("SELECT * FROM $tabla,usuarios ");
	$sql->execute();
	?>
		<form method="post">
		<?php foreach ($sql as $key) :?>
			<input type="hidden" name="fecha[]" value="<?php echo date("Y-m-d"); ?>">
			<input type="hidden" name="idproducto[]" value="<?php echo $key['idproducto'] ?>">
			<input type="hidden" name="precio[]" value="<?php echo $key['precio'] ?>">
			<input type="hidden" name="idusuario[]" value="<?php echo $key['idusuario'] ?>">
		<?php endforeach; ?>  
		<input type="submit" class="btn btn-danger" name="venta" value="$ Finalizar Venta">
		<input type="submit" class="btn btn-danger" name="Imprimir" value="$ Imprimir Venta" onclick="imprimir()">
		</form> 
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
	function imprimir(){
		var objeto=document.getElementById('prueba');  //obtenemos el objeto a imprimir
		var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
		ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
		ventana.document.close();  //cerramos el documento
		ventana.print();  //imprimimos la ventana
		ventana.close();  //cerramos la ventana
	}

	function calcularTotal() {		
		 console.log($("#precioUnitario").val());
		 console.log($("#cantidadProducto").val());
		 var multipli = ($("#precioUnitario").val()) * ($("#cantidadProducto").val());
		 console.log(multipli);
		 console.log($("#cantidadProducto").val());
		 //console.log($('.table-bordered th').val());
		 //$("#totalProducto").val(multipli);		 

		// var idmesa = ($('#idmesa').val());
		// var url = 'Views/modules/ventas/actualizarVentas.php';
		// $.ajax({
		// 	type:'POST',
		// 	url:url,
		// 	data: {idmesa},
		// 	success: function (response) {
		// 		alert(response);
		// 	}
		// });
		
	}

	function resaltarPendiente() {		
		var t = document.getElementsByTagName('tr');
		if ($key['estado'] == "PENDIENTE"){
		t[0].style.backgroundColor = '#d9534f';
	}

 	function actualizarTotales(){
		calcularTotal();
		 alert("COMIENZA A ACTUALIZAR"); 
 	}
	}
</script>