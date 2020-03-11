<style type="text/css">
	.caption {
		background-color:#FFF;
		border: 1px solid #ccc
	}
</style>

<div class="container-fluid">
	
	<div class="row">
		<div class="col-xs-5">
	 		<h3 style="color: #FFF; margin-bottom: 40px">Pedidos y mesas</h3>			
		</div>

		<div class="col-xs-3">
			<button type="button" class="btn btn-primary btn-sm nuevo_pedido" data-toggle="modal" data-target="#bebidas" data-whatever="@mdo" data-id="">
				<i class="fa fa-plus-square"></i> 
				Nuevo Pedido 
			</button>
			<?php
				$cantidad_mesas = 25;
				require 'Views/modules/ventas/conexion.php';
				require 'Views/modal/modal_agregar_productos.php';
				require 'Views/modal/modal_entregar_pedido.php';
				require 'Views/modal/modal_cancelar_pedido.php';
			?>
	 	</div>
		<div class="col-xs-4">
			
	 		<a href="#" class="btn btn-primary btn-sm pull-right" role="button" onclick="window.print()">
	 			<i class="fa fa-print" aria-hidden="true"></i>
	 			Imprimir todos
	 		</a>
	 	</div>
	</div>

	<div class="row">
	<?php
		$total = 0;
		$c = 0;
		for ($i = 1; $i <= $cantidad_mesas; $i++):
			$consult = $conexion->query("SELECT * FROM mesa$i ta JOIN productos pro ON ta.idproducto = pro.idproducto where ta.id_estado_producto != 2");			
			$total = 0;
			$count = 0;
			$rows = '';

			foreach ($consult as $key) {
				$count++;
				$check = "";
				$estado = $key['id_estado_producto'];
				if($estado == 0){
					$check = 'checked="true"';
				}
				$rows .= '    
				<tr>
					<td><input data-mesa="'.$key['mesa'].'" data-id="'.$key['idmesa'].'" type="checkbox" name="productosEstado" '.$check.' value="'.$i.'"></td>
					<th scope="row">'.$count.'</th>
					<td>'.$key['nombreproducto'].'</td>
					<td>'.number_format($key['precio'], 0, ',', '.').'</td>
					<td>'.$key['cantidad'].'</td>
					<td>'.number_format($key['precio_total_producto'], 0, ',', '.').'</td>
					<td><button data-total-item="'.$key['precio_total_producto'].'" data-mesa="'.$key['mesa'].'" data-id="'.$key['idmesa'].'" class="eliminarItem">&times;</button></td>
					</tr>';
				$total += $key['precio_total_producto'];
			}
			if ($consult->rowCount()):
				$c++;
	 ?>
		<div class="col-sm-12 col-md-4 col-xs-12 col-lg-4 cards-new form-group">
		  <div class="caption">
		    <h3>
		    	Mesa <?=$i?>
		    	<button href="#" class="btn btn-danger btn-sm pull-right imprimirPendientes" data-id="mesa<?=$i?>">
				<i class="fa fa-print" aria-hidden="true"></i>
					Imprimir Pendientes
				</button>
				<a href="#" class="btn btn-success btn-sm pull-right nuevo_pedido" role="button"
		    		data-toggle="modal" data-target="#bebidas" data-whatever="@mdo" data-id="<?=$i?>"
		    	>
		    		<i class="fa fa-plus" aria-hidden="true"></i>
					Adicionar
				</a>
			</h3>
		    <p>
				<div class="container-fluid">
				<div class="row">
				<div class="col-*-*">
				<table class="table table-striped" style=" width:100%;font-size: 12px;">
					<thead>
						<tr>
							<th scope="col">Estado</th>
							<th scope="col">#</th>
							<th scope="col">Prod.</th>
							<th scope="col">Precio</th>
							<th scope="col">Cant.</th>
							<th scope="col">Sub&nbsp;Total</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
		    			<?= $rows ?>
				  	</tbody>
				</table>
				</div>
				</div>
				</div>
		    </p>
		    <hr>
		    <div class="row">
			   <p class="col-lg-12">
				    <span class="pull-right" style="margin-right: 15px">
				    	<b>TOTAL:</b> <span id="<?=$i?>" data-total="<?=$total?>"><?=number_format($total, 0, ',', '.')?> Gs</span>	
				    </span>
			    </p>
		    </div>
			<div class="row">
			   <p class="col-lg-12" style="text-align: center">
			   	
			   		<a href="#" class="btn btn-success btn-sm entregar_pedido" role="button"
		    		data-toggle="modal" data-target="#entregar_pedido" data-whatever="@mdo" data-id="<?=$i?>">
			    		<i class="fa fa-check" aria-hidden="true"></i>
			    		Finalizar pedido
			    	</a> 

			    	<a href="#" class="btn btn-danger btn-sm cancelar_pedido" role="button"
		    		data-toggle="modal" data-target="#cancelar_pedido" data-whatever="@mdo" data-id="<?=$i?>">
			    		<i class="fa fa-remove" aria-hidden="true"></i>
			    		Cancelar
			    	</a>
		    	</p>
			</div>
		  </div>
		</div>
	<?php 
		endif;
		if ( is_integer(($c/4)) ) {
			echo '</div>';
			if ($i < $cantidad_mesas) {
				echo '<div class="row">';
			}
		}
		endfor;
		
	 ?>
	
</div>

<script type="text/javascript">
	$('.nuevo_pedido').on('click', function(){
      id = $(this).attr('data-id');
      
      if(id){
        $('#mesa').hide().prop('required', false);
        $('#mesa_adicion').html('<option readonly value="'+id+'">Mesa '+id+'</option>').show();
      } else {
        $('#mesa').show().prop('required', true);
        $('#mesa_adicion').html('').hide();
      }
    })

    $('.entregar_pedido').on('click', function(){
    	$('.nro_mesa').text($(this).attr('data-id'));
    	$('#tabla_entregar').val('mesa' + $(this).attr('data-id'));
    })

    $('.cancelar_pedido').on('click', function(){
    	$('.nro_mesa').text($(this).attr('data-id'));
    	$('#tabla_cancelar').val('mesa' + $(this).attr('data-id'));
	})
	//Verificamos cuantos items de productos hay en nuestra vista
	var items = document.getElementsByClassName("eliminarItem");

	//Seleccionamos cada uno de los items de productos y le agregamos acciones para que puedan ser eliminados
	//Al igual que extraemos los valores de sus atributos y hacemos una serie de operaciones con ellos
	for(var cont = 0; cont<items.length; cont++){
		items[cont].addEventListener('click',function(e){
			e.preventDefault();
			var totalVenta = document.getElementById(e.target.getAttribute("data-mesa")).getAttribute("data-total");			
			totalVenta -= e.target.getAttribute("data-total-item");
			document.getElementById(e.target.getAttribute("data-mesa")).setAttribute("data-total",totalVenta);
			document.getElementById(e.target.getAttribute("data-mesa")).innerHTML = `${new Intl.NumberFormat("de-DE").format(totalVenta)} &nbsp;Gs`
			//Preparo los datos que necesito para enviar a la funcion para eliminar el item
			let arrayDatos = {id:e.target.getAttribute("data-id"),idMesa:e.target.getAttribute("data-mesa")};
			eliminarItemDeLaBaseDeDatos(arrayDatos)
			var padre = e.target.parentNode.parentNode.parentNode;
			//Con esto le digo al item que ya no se muestre
			padre.removeChild(e.target.parentNode.parentNode);
		});
	}

	//Este metodo su principal objetivo es eliminar de la base de datos el registro que contempla en los datos del array que se pasa como parametro
	function eliminarItemDeLaBaseDeDatos(arrayDatos){
		var response;
		var rutaLargo = (location.href).length
		var rutaAcortada = (location.href).substring(0,rutaLargo-15);
		var request = new XMLHttpRequest();
		var data = new FormData();
		data.append('eliminaritem',arrayDatos.id);
		data.append('numerodemesa',arrayDatos.idMesa);
		request.open('POST',`${rutaAcortada}principalVentas`,true);
		request.onload = (e)=>{
			response = request.response;
		}
		request.send(data);
	}

	//Metodos que nos van a ayudar a saber cuales son los pedidos entregados
	//Extraemos todos los checkbox asociados a cada una de las mesas
	var CheckMesasEstado = document.getElementsByName('productosEstado');

	for(var cont = 0; cont < CheckMesasEstado.length; cont++){
		CheckMesasEstado[cont].addEventListener('change',(e)=>{
			e.preventDefault();
			if(e.target.checked){
				var datos = {idproducto:e.target.getAttribute("data-id") ,idmesa:e.target.getAttribute("data-mesa"), estado:"0" }
				actualizarEstadoDelProductoEnLaBD(datos);
			}else{
				var datos = {idproducto:e.target.getAttribute("data-id") ,idmesa:e.target.getAttribute("data-mesa"), estado:"1" }
				actualizarEstadoDelProductoEnLaBD(datos);
			}
		});
	}

	function actualizarEstadoDelProductoEnLaBD(datos){
		var response;
		var rutaLargo = (location.href).length
		var rutaAcortada = (location.href).substring(0,rutaLargo-15);
		var request = new XMLHttpRequest();
		var data = new FormData();
		data.append('actualizarestadoproducto',datos.estado);
		data.append('idproducto',datos.idproducto);
		data.append('numerodemesa',datos.idmesa);
		request.open('POST',`${rutaAcortada}principalVentas`,true);
		request.onload = (e)=>{
			e.preventDefault();
			response = request.response;
		}
		request.send(data);
	}


	var pendientes = document.getElementsByClassName('imprimirPendientes');
	for(var cont = 0;cont<pendientes.length;cont++){
		pendientes[cont].addEventListener('click',function(event){
			event.preventDefault();
			myWindow = window.open(`Views/modules/ventas/reportes/pedidos_pendientes.php?mesa=${event.target.getAttribute('data-id')}`,'ticket','width=1000,height=550,scrollbars=1,menubar=yes,toolbar=yes')
			myWindow.focus();
		});
	}
</script>