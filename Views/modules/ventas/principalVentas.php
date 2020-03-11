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

		<div class="col-xs-5">
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

		<div class="col-xs-2">
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
			$consult = $conexion->query("SELECT * FROM mesa$i ta JOIN productos pro ON ta.idproducto = pro.idproducto
								JOIN estados_productos EP ON ta.id_estado_producto = EP.id_estado_producto
								WHERE ta.id_estado_producto = 1");			
			$total = 0;
			$count = 0;
			$rows = '';

			foreach ($consult as $key) {
				$count++;
				$rows .= '    
				<tr>
					<th scope="row">'.$count.'</th>
					<td>'.$key['nombreproducto'].'</td>
					<td>'.number_format($key['precio'], 0, ',', '.').'</td>
					<td>'.$key['cantidad'].'</td>
					<td>'.number_format($key['precio_total_producto'], 0, ',', '.').'</td>
			    </tr>';
				$total += $key['precio_total_producto'];
			}
			if ($consult->rowCount()):
				$c++;
	 ?>
		<div class="col-sm-12 col-lg-3 col-lg-3 cards-new form-group">
		  <div class="caption">
		    <h3>
		    	Mesa <?=$i?>
		    	<a href="#" class="btn btn-success btn-sm pull-right nuevo_pedido" role="button"
		    		data-toggle="modal" data-target="#bebidas" data-whatever="@mdo" data-id="<?=$i?>"
		    	>
		    		<i class="fa fa-plus" aria-hidden="true"></i>
					Adicionar
				</a>
			</h3>
		    <p>
				<table class="table table-striped" style="font-size: 13px;">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Prod.</th>
							<th scope="col">Precio</th>
							<th scope="col">Cant.</th>
							<th scope="col">Sub&nbsp;Total</th>
						</tr>
					</thead>
					<tbody>
		    			<?= $rows ?>
				  	</tbody>
				</table>
		    </p>
		    <hr>
		    <div class="row">
			   <p class="col-lg-12">
				    <span class="pull-right" style="margin-right: 15px">
				    	<b>TOTAL:</b> <?=number_format($total, 0, ',', '.')?> Gs	
				    </span>
			    </p>
		    </div>
			<div class="row">
			   <p class="col-lg-12" style="text-align: center">
			   	
			   		<a href="#" class="btn btn-success btn-sm entregar_pedido" role="button"
		    		data-toggle="modal" data-target="#entregar_pedido" data-whatever="@mdo" data-id="<?=$i?>">
			    		<i class="fa fa-check" aria-hidden="true"></i>
			    		Entregar pedido
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
</script>