
<div class="modal fade" id="bebidas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center><h5 class="modal-title" id="exampleModalLabel">Agregar Pedidos</h5></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
        <div id="campos">
        <div class="row form-group">  
          <div class="col-md-6">
           <?php  $consul = $conexion->query("SELECT * FROM usuarios");  ?>
              <?php foreach ($consul as $key): ?>
                <input type="hidden" name="usuario" value="<?php echo $key['idusuario'] ?>">
              <?php endforeach ?>
               <?php
              $consul = $conexion->query("SELECT * FROM productos pro JOIN categorias cat ON pro.idcategoria = cat.idcategoria WHERE nombrecategoria= 'BEBIDAS'  order by nombreproducto asc");      
              ?>
            <select class="form-control chosen-select" id="bebidas_select" name="select_items[]">
            <option value="0"  required="" class="dropdown-header">SELECCIONA UNA OPCION</option>
             <option class="divider"></option>
                  <?php foreach ($consul as $fila): ?>
               <option value="<?php echo $fila['idproducto']. '-' .  $fila['precio'] ?>" > <?php echo ucwords($fila['nombreproducto'])?> 
              </option>
                <?php endforeach ?>
                <?php             
            $consul = $conexion->query("SELECT * FROM productos pro JOIN categorias cat ON pro.idcategoria = cat.idcategoria WHERE nombrecategoria= 'CARNE'  order by nombreproducto asc");      
            ?>
               <option class="divider"></option>     
                    <?php foreach ($consul as $fila): ?>
                 <option value="<?php echo $fila['idproducto']. '-' .  $fila['precio'] ?>"> <?php echo ucwords($fila['nombreproducto'])?> 
                </option>
                  <?php endforeach ?>
                  <?php             
            $consul = $conexion->query("SELECT * FROM productos pro JOIN categorias cat ON pro.idcategoria = cat.idcategoria WHERE nombrecategoria= 'POSTRES'  order by nombreproducto asc");      
            ?>
            <option class="divider"></option> 
                  <?php foreach ($consul as $fila): ?>
               <option value="<?php echo $fila['idproducto']. '-' .  $fila['precio'] ?>"> <?php echo ucwords($fila['nombreproducto'])?> 
              </option>
                <?php endforeach ?>
                <?php             
            $consul = $conexion->query("SELECT * FROM productos pro JOIN categorias cat ON pro.idcategoria = cat.idcategoria WHERE nombrecategoria= 'VERDULERIAS'  order by nombreproducto asc");      
          ?>
          <option class="divider"></option> 
            <?php foreach ($consul as $fila): ?>
            <option value="<?php echo $fila['idproducto']. '-' .  $fila['precio'] ?>"> <?php echo ucwords($fila['nombreproducto'])?> 
            </option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-2">
            <label class="control-label">Cantidad:</label>
          </div>
          <div class="col-md-2">
            <input type="number" name="cantidad_items[]" min="0" id="cantidad_bebida" value="0" maxlength="3" class="form-control"> 
          </div>
          <div class="col-md-2">
            <label class="control-label subtotal" id="subtotal_bebida" data-subtotal="0">0&nbsp;Gs</label>
          </div>
        </div>
        </div>
        <div class="row form-group">
        <div class="col-md-6">
          <select class="form-control chosen-select" id="mesa" name="mesa" required="">
           <option value="" >SERVICIOS DE MESAS</option>
            <?php 
                for ($j = 1; $j <= $cantidad_mesas; $j++): 
                  $consult = $conexion->query("SELECT * FROM mesa$j ta JOIN productos pro ON ta.idproducto = pro.idproducto JOIN estados_productos EP ON ta.id_estado_producto = EP.id_estado_producto 
                    WHERE ta.id_estado_producto = 1");
                  $disabled   = '';
                  $mensaje    = '';
                  $color      = '';
                  if ($consult->rowCount()){
                    $disabled   = 'disabled';
                    $mensaje    = '(Ocupada)';
                    $color      = 'background-color:red;color:white;';
                  }
            ?>
                  <option <?=$disabled?> style='<?=$color?>' value="<?=$j?>"> Mesa <?=$j.' '.$mensaje?> </option>
            <?php 
                endfor; 
            ?>
          </select>

          <select class="form-control chosen-select" id="mesa_adicion" name="mesa_adicion"></select>
        </div>          
        
      </div>

        <button class="btn btn-success" id="agregarProductos"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Agregar Productos</button>
        <button class="btn btn-danger" id="removerProductos"><i class="fa fa-minus" aria-hidden="true"></i>&nbsp;Remover Producto</button>
      
      <div class="alert alert-success" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <strong>TOTAL</strong>
          <strong class="pull-right" id="total_pedido" data-total_pedido="0">0&nbsp;Gs</strong>
        </div>
      <input type="hidden" name="fecha" value="<?php echo date('d-m-Y'); ?>">
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" name="agregarMesas" id="agregarMesas" class="btn btn-primary">Agregar</button>        
      </div>
     </form>
    </div>
  </div>
</div>
 </div>

 <script type="text/javascript">
  var campo = String((document.getElementById('campos').children[0]).outerHTML);
  var formulario = document.getElementById('campos');
  //Estamos accediendo a las opciones del select
  let selectOption = formulario.children[0].children[0].children[3];

  //Estamos accediendo al campo de cantidad
  let campoCantidad = formulario.children[0].children[2].children[0];

  //Estamos accediendo al texto del subtotal
  let textoSubTotal = formulario.children[0].children[3].children[0];

  //Estamos accediendo al texto con la cantidad de total venta en el pedido
  let total_pedido = document.getElementById('total_pedido');

  //Agregamos eventos a los campos de seleccion y de cantidad
  //Cada vez que cambia de seleccion se ejecuta este evento
  selectOption.addEventListener('change',(event)=>{
    event.preventDefault();
    let valorSeleccionado = event.target.value;
    let precioProducto = valorSeleccionado.substring(valorSeleccionado.indexOf('-')+1);
    let cantidadProducto = campoCantidad.value;
    if(cantidadProducto < 1){
      campoCantidad.value = 1;
      cantidadProducto = 1;
    }
    let subTotal = parseInt(precioProducto * cantidadProducto);
    textoSubTotal.setAttribute('data-subtotal', subTotal);
    textoSubTotal.innerHTML = `${subTotal}&nbsp;Gs`;
    console.log(`El precio del producto es ${precioProducto} y la cantidad es ${cantidadProducto}`);
    verificarTotalPedido();
  });

  campoCantidad.addEventListener('keyup',(event)=>{
    event.preventDefault();
    let cantidadProducto = event.target.value;
    let valorSeleccionado = selectOption.value;
    let precioProducto = valorSeleccionado.substring(valorSeleccionado.indexOf('-')+1);
    let subTotal = parseInt(precioProducto * cantidadProducto);
    textoSubTotal.setAttribute('data-subtotal', subTotal);
    textoSubTotal.innerHTML = `${subTotal}&nbsp;Gs`;
    verificarTotalPedido();
  });
  campoCantidad.addEventListener('change',(event)=>{
    event.preventDefault();
    let cantidadProducto = event.target.value;
    let valorSeleccionado = selectOption.value;
    let precioProducto = valorSeleccionado.substring(valorSeleccionado.indexOf('-')+1);
    let subTotal = parseInt(precioProducto * cantidadProducto);
    textoSubTotal.setAttribute('data-subtotal', subTotal);
    textoSubTotal.innerHTML = `${subTotal}&nbsp;Gs`;
    verificarTotalPedido();
  });
  document.getElementById('agregarProductos').addEventListener('click', function(e){
    e.preventDefault();
    formulario.insertAdjacentHTML("beforeend",campo);
    agregarEventosAlNuevoHijo(formulario);
  });

  document.getElementById('removerProductos').addEventListener('click',function(e){
    e.preventDefault();
    var cantidadItems = formulario.children.length;
    if(cantidadItems>1){
    formulario.removeChild(formulario.children[cantidadItems-1]);
    verificarTotalPedido();
    }
  });

  function verificarTotalPedido(){
    let cantidadDeItems = formulario.children.length;
    var cantidadTotalVentaPedido = 0;
    for(var cont = 0; cont<cantidadDeItems; cont++){
      cantidadTotalVentaPedido += parseInt(formulario.children[cont].children[3].children[0].getAttribute('data-subtotal'));
    }
    total_pedido.innerHTML = `${cantidadTotalVentaPedido}&nbsp;Gs`;
    console.log(cantidadTotalVentaPedido);
  }
  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
  }

  function agregarEventosAlNuevoHijo(formulario){
    var numeroDeItem = formulario.children.length-1;
    let selectOptionHijo = formulario.children[numeroDeItem].children[0].children[3];
    let campoCantidadHijo = formulario.children[numeroDeItem].children[2].children[0];
    let textoSubTotalHijo = formulario.children[numeroDeItem].children[3].children[0];
    
    selectOptionHijo.addEventListener('change',(event)=>{
      event.preventDefault();
      let valorSeleccionado = event.target.value;
      let precioProducto = valorSeleccionado.substring(valorSeleccionado.indexOf('-')+1);
      let cantidadProducto = campoCantidadHijo.value;
      if(cantidadProducto < 1){
        campoCantidadHijo.value = 1;
        cantidadProducto = 1;
      }
      let subTotal = parseInt(precioProducto * cantidadProducto);
      textoSubTotalHijo.setAttribute('data-subtotal', subTotal);
      textoSubTotalHijo.innerHTML = `${subTotal}&nbsp;Gs`;
      console.log(`El precio del producto es ${precioProducto} y la cantidad es ${cantidadProducto}`);
      verificarTotalPedido();
    });

    campoCantidadHijo.addEventListener('keyup',(event)=>{
      event.preventDefault();
      let cantidadProducto = event.target.value;
      let valorSeleccionado = selectOptionHijo.value;
      let precioProducto = valorSeleccionado.substring(valorSeleccionado.indexOf('-')+1);
      let subTotal = parseInt(precioProducto * cantidadProducto);
      textoSubTotalHijo.setAttribute('data-subtotal', subTotal);
      textoSubTotalHijo.innerHTML = `${subTotal}&nbsp;Gs`;
      verificarTotalPedido();
    });
    campoCantidadHijo.addEventListener('change',(event)=>{
      event.preventDefault();
      let cantidadProducto = event.target.value;
      let valorSeleccionado = selectOptionHijo.value;
      let precioProducto = valorSeleccionado.substring(valorSeleccionado.indexOf('-')+1);
      let subTotal = parseInt(precioProducto * cantidadProducto);
      textoSubTotalHijo.setAttribute('data-subtotal', subTotal);
      textoSubTotalHijo.innerHTML = `${subTotal}&nbsp;Gs`;
      verificarTotalPedido();
    });
  }
 /* function cuenta_subtotal(cantidad, me){
    $('#cantidad_'+me).val(cantidad);
    select_val = $('#'+me+'s_select').val();
    console.log(`El valor seleccionado es : ${select_val}`);
    indice = select_val.indexOf("-");
    console.log(`El indice es : ${indice}`);
    id = select_val.substring(0, indice);
    console.log(`El id es : ${id}`);
    precio = select_val.substring( parseInt(indice + 1) );
    console.log(`El precio es : ${precio}`);    
    subtotal = precio*cantidad;
    console.log(`El subtotal es : ${subtotal}`);
    $('#subtotal_'+me).html(formatNumber(subtotal)+'&nbsp;Gs').attr('data-subtotal', subtotal);

    total_pedido = 0;
    $('.subtotal').each(function(i){
      subtotales = $(this).attr('data-subtotal');
      total_pedido = parseInt(total_pedido) + parseInt(subtotales);
    })

    $('#total_pedido').html(formatNumber(total_pedido)+'&nbsp;Gs').attr('data-total_pedido', total_pedido);
  }
/*


  //--------------------------------------------
  $('#cantidad_bebida').on('keyup', function(){
    cantidad = $(this).val()
    console.log(`La cantidad pedida es de : ${cantidad}`);
    cuenta_subtotal(cantidad, 'bebida')
  })

  $('#bebidas_select').on('change', function(){4
    cantidad = $(this).val() ? cantidad = 1: '';
    cuenta_subtotal(cantidad, 'bebida')
  })

  //--------------------------------------------
  $('#cantidad_carne').on('keyup', function(){
    cantidad = $(this).val()
    cuenta_subtotal(cantidad, 'carne')
  })

  $('#carnes_select').on('change', function(){4
    cantidad = $(this).val() ? cantidad = 1: '';
    cuenta_subtotal(cantidad, 'carne')
  })
  
  //--------------------------------------------
  $('#cantidad_postre').on('keyup', function(){
    cantidad = $(this).val()
    cuenta_subtotal(cantidad, 'postre')
  })

  $('#postres_select').on('change', function(){4
    cantidad = $(this).val() ? cantidad = 1: '';
    cuenta_subtotal(cantidad, 'postre')
  })

  //--------------------------------------------
  $('#cantidad_ensalada').on('keyup', function(){
    cantidad = $(this).val()
    cuenta_subtotal(cantidad, 'ensalada')
  })

  $('#ensaladas_select').on('change', function(){4
    cantidad = $(this).val() ? cantidad = 1: '';
    cuenta_subtotal(cantidad, 'ensalada')
  })*/
</script>

<?php 
require 'Controller/mesasController/mesasController.php';
$regis = new MesasController();
$regis->agregarMesasController();
if(isset($_POST['cancelarMesas'])){
    $tabla = $_POST['tabla_cancelar'];
    $regis->cancelarMesasController($tabla);
}
if(isset($_POST['entregarMesas'])){
    $tabla = $_POST['tabla_entregar'];
    $regis->entregarMesasController($tabla);
}
?>