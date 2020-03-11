<?php  
ob_start();
require_once 'Model/conexion.php';
class MesasController {

  public function agregarMesasController(){
    $conexion = Conexion::conectar();

  	if (isset($_POST['agregarMesas'])) {

      $fecha = $_POST['fecha'];
      $usu = $_POST['usuario'];
      $mesa = isset($_POST['mesa_adicion']) ? $_POST['mesa_adicion'] : $_POST['mesa'];
      $mesa_adicion = isset($_POST['mesa_adicion']) ? "mesa".$_POST['mesa_adicion']: 0;
      $tabla = "mesa".$mesa;
      if ($mesa_adicion) {
        $tabla = $mesa_adicion;
      }
      // 1- ------------------------------------------------------------------------------
      if(isset($_POST['select_items'])){
        $arrayDeItems = $_POST['select_items'];
        $arrayDeCantidadDeCadaItem = $_POST['cantidad_items'];
        $cantidadDeItems = sizeof($_POST['select_items']);

        for($cont = 0; $cont<$cantidadDeItems; $cont++){
          $valorTemporal = $arrayDeItems[$cont];
          list($idproducto,$precio_bebida) = explode('-' , $valorTemporal);
        $cantidad_bebida = $arrayDeCantidadDeCadaItem[$cont];
        $precio_total_bebida = $precio_bebida * $cantidad_bebida;


        if ($mesa_adicion === 0) {
          $this->insertMesa(
            $tabla, $idproducto, $usu, $fecha, $mesa, $cantidad_bebida, $precio_bebida, $precio_total_bebida
          );
        } else {
          $consult = $conexion->query("SELECT idmesa, cantidad FROM $tabla where idproducto = $idproducto and id_estado_producto = 1");
          $idmesa = 0;
          foreach ($consult as $key){
            $idmesa = $key['idmesa'];
          }
          if ($consult->rowCount()) {
            $cantidad_bebida = $key['cantidad'] + $cantidad_bebida;
            $precio_total_bebida = $precio_bebida * $cantidad_bebida;
            $this->updateMesa(
              $tabla, $usu, $cantidad_bebida, $precio_bebida, $precio_total_bebida, $idmesa
            );
          } else {
            $this->insertMesa(
              $tabla, $idproducto, $usu, $fecha, $mesa, $cantidad_bebida, $precio_bebida, $precio_total_bebida
            );
          }
        }
        }
      }
      /*if($_POST['bebidas_select']) {              
            
      } 
      // 2- --------------------------------------------------------------------------------- 
      if($_POST['carnes_select']) {
        list($idproducto,$precio_carne) = explode('-' , $_POST['carnes_select']);
        $cantidad_carne = $_POST['cantidad_carne'];
        $precio_total_carne = $precio_carne * $cantidad_carne;
        $this->insertMesa(
          $tabla, 
          $idproducto, 
          $usu, 
          $fecha, 
          $mesa, 
          $cantidad_carne, 
          $precio_carne, 
          $precio_total_carne
        );
      }
      // 3- -------------------------------------------------------------------------------------
      if($_POST['postres_select']) {
        list($idproducto,$precio_postre) = explode('-' , $_POST['postres_select']);
        $cantidad_postre = $_POST['cantidad_postre'];
        $precio_total_postre = $precio_postre * $cantidad_postre;
        $this->insertMesa(
          $tabla, 
          $idproducto, 
          $usu, 
          $fecha, 
          $mesa, 
          $cantidad_postre, 
          $precio_postre, 
          $precio_total_postre
        );
      }
      // 4- -------------------------------------------------------------------------------------
      if($_POST['ensaladas_select']) {
        list($idproducto,$precio_ensalada) = explode('-' , $_POST['ensaladas_select']);
        $cantidad_ensalada = $_POST['cantidad_ensalada'];
        $precio_total_ensalada = $precio_ensalada * $cantidad_ensalada;
        $this->insertMesa(
          $tabla, 
          $idproducto, 
          $usu, 
          $fecha, 
          $mesa, 
          $cantidad_ensalada, 
          $precio_ensalada, 
          $precio_total_ensalada
        );
      } */     
      // ---------------------------------------------------------------------------------------
      // if ($respuesta == 'success') {
       header('location:principalVentas');
      // }else{
      //   header('location:mesas');
      // }
    }
    if(isset($_POST['actualizarestadoproducto'])){
      $this->actualizarEstadoProducto($_POST['actualizarestadoproducto'],$_POST['idproducto'],"mesa".$_POST['numerodemesa']);
    }
    if(isset($_POST['eliminaritem'])){
      $idmesa = $_POST['eliminaritem'];
      $numeroDeMesa = "mesa".$_POST['numerodemesa'];
      $this->eliminarProducto($idmesa,$numeroDeMesa);
    }

    
  }
  public function actualizarEstadoProducto($estado,$idproducto,$numeroDeMesa){
    $conexion = Conexion::conectar();
    $conexion->exec("UPDATE $numeroDeMesa SET id_estado_producto=$estado WHERE idmesa = $idproducto");
  }
  public function eliminarProducto($idmesa,$numeroDeMesa){
    echo "<script>console.log('Ya estoy comenzando a eliminar');</script>";
    $conexion = Conexion::conectar();
    $conexion->exec("DELETE FROM $numeroDeMesa WHERE idmesa = $idmesa");
  }

  public function insertMesa($tabla, $idproducto, $usu, $fecha, $mesa, $cantidad_bebida, $precio_bebida, $precio_total_bebida){
    $conexion = Conexion::conectar();
    $sql = $conexion->prepare("
      INSERT INTO $tabla 
      (
        idproducto, 
        idusuario, 
        fecha, 
        mesa, 
        cantidad, 
        precio, 
        precio_total_producto
      ) VALUES (
        :idproducto, 
        :idusuario, 
        :fecha, 
        :mesa,
        :cantidad,
        :precio, 
        :precio_total_producto
      )");
    $sql->execute(
      array(
        ':idproducto'=>$idproducto,
        ':idusuario'=>$usu,         
        ':fecha'=>$fecha,
        ':mesa'=>$mesa,
        ':cantidad'=>$cantidad_bebida,
        ':precio'=>$precio_bebida,
        ':precio_total_producto'=>$precio_total_bebida
      )
    );
    header('location:principalVentas');
  }

  public function updateMesa($tabla, $usu, $cantidad, $precio, $precio_total_producto, $idmesa)
  {
    $conexion = Conexion::conectar();

    $sql= $conexion->prepare("UPDATE $tabla SET                                   
                                   idusuario = :idusuario,
                                   precio = :precio,
                                   cantidad = :cantidad, 
                                   precio_total_producto = :precio_total_producto 
                        WHERE idmesa = $idmesa");

      $sql->bindParam(':idusuario',$usu, PDO::PARAM_INT);
      $sql->bindParam(':precio',$precio, PDO::PARAM_INT);
      $sql->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
      $sql->bindParam(':precio_total_producto',$precio_total_producto, PDO::PARAM_INT);

      $sql->execute();
      header('location:principalVentas');
  }


  public function cancelarMesasController($tabla)
  {
    $conexion = Conexion::conectar();

    $id_estado_producto = 3;
    $search = 1;
    $sql= $conexion->prepare("UPDATE $tabla SET 
                                      id_estado_producto = :id_estado_producto 
                              WHERE id_estado_producto = $search");
    $sql->bindParam(':id_estado_producto',$id_estado_producto, PDO::PARAM_INT);
    $sql->execute();
    header('location:principalVentas');
  }

  public function entregarMesasController($tabla)
  {
    $conexion = Conexion::conectar();
    
    $id_estado_producto = 2;
    $search = 1;
    $sql= $conexion->prepare("UPDATE $tabla SET 
                                      id_estado_producto = :id_estado_producto 
                              WHERE id_estado_producto = $search");
    $sql->bindParam(':id_estado_producto',$id_estado_producto, PDO::PARAM_INT);
    $sql->execute();
    header('location:principalVentas');
  }

    public function getCategoriasController(){
      $respuesta = CategoriasModel::getCategoriasModel('categorias');

       foreach ($respuesta as $row) {
         echo '<tr> 
              <td align="center"> '. $row['nombrecategoria'].'</td>
              <td align="center"><a href="index.php?action=editarcategoria&idcategoria='.$row['idcategoria'].'" <i class="fa fa-edit btn btn-primary btn-sm"></i> </a>
               <a class="fa fa-trash btn btn-danger  btn-sm" href="index.php?action=categorias&idBorrar='.$row['idcategoria'].'" &nbsp;  </a>
              </td>
              </tr>';
       }
    }

    public function editarCategoriasController(){
            $datosController= $_GET['idcategoria'];
      $respuesta = CategoriasModel::editarCategoriasModel($datosController,'categorias');

  echo'  <div class="col-md-8">  
              <div class="form-group">
              <label for="categoria-name" class="form-control-label">Nombre Categoria :</label>
                <input type="text" class="form-control" id="categoria-name" name="nombrecategoria" value="'.$respuesta['nombrecategoria'].' ">
              </div>       
        <input type="hidden" name="idcategoria" value="'.$respuesta['idcategoria'].'">
          <button type="submit" class="btn btn-primary" name="editarCategorias">Editar la  Categoria</button>
          </div>
   <div class="col-md-4">
     <img src="assets/img/foto3.jpg" width="350" height="285"">
   </div>';
    }

   public function actualizarCategoriaController(){
         if (isset($_POST['editarCategorias'])) {

          $datosController= array("nombrecategoria"=>$_POST['nombrecategoria'],
                                     'idcategoria'=>$_POST['idcategoria']);
          #pedir la informacion al modelo.

          $respuesta= CategoriasModel::actualizarCategoriaModel($datosController,'categorias');
      
          if ($respuesta == 'success') {
                header('location:okEdit');
          }
        }
     }


  public function deleteCategoriasController(){
     if (isset($_GET['idBorrar'])) {
      $datosController = $_GET['idBorrar'];

   #pedir la informacion al modelo.
      $respuesta = CategoriasModel::deleteCategoriasModel($datosController,'categorias');
      if ($respuesta == 'success') {
         header('location:borrarCategorias');
      }
     }
   }
     

}