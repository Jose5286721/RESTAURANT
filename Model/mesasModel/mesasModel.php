<?php  

 require_once 'Model/conexion.php';

 class MesasModel{
         

    #-----------------------------------------------------------
    #INGRESAR NUEVAS MESAS
    public function agregarMesasModel($datosModel ,$tabla){
      $sql = Conexion::conectar()->prepare("INSERT INTO  $tabla (nombrecategoria) VALUES(:nombrecategoria)");

       $sql->bindParam(':nombrecategoria',$datosModel['nombrecategoria'], PDO::PARAM_STR);

       if ($sql->execute()) {
               return 'success';
            }else{
                return 'error';
            }

      $sql->close();
     }
  //AGREGAR PEDIDOS NUEVOS
  if (isset($_POST['agregarBebidas'])) {
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = $_POST['fecha'];
    // echo $fecha;
    $usu = $_POST['usuario'];
    $producto = $_POST['producto'];
     print_r($producto);
     exit;
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
          #-----------------------------------------------------------
       #OBTENER TODAS LAS CATEGORIAS
       public function getCategoriasModel($tabla){
         
         $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla");
         $sql->execute();
         return $sql->fetchAll();

         $sql->close();

       }

       public function editarCategoriasModel($datosModel,$tabla){
        $sql = Conexion::conectar()->prepare("SELECT * FROM  $tabla WHERE idcategoria = :idcategoria");

        $sql->bindParam(':idcategoria',$datosModel,PDO::PARAM_INT);

        $sql->execute();
        return $sql->fetch();

        $sql->close();
       }

     function actualizarCategoriaModel($datosModel,$tabla){
        $sql= Conexion::conectar()->prepare("UPDATE $tabla SET nombrecategoria = :nombrecategoria WHERE idcategoria = :idcategoria");

      $sql->bindParam(':nombrecategoria',$datosModel['nombrecategoria'], PDO::PARAM_STR);
      $sql->bindParam(':idcategoria',$datosModel['idcategoria'], PDO::PARAM_INT);
           
      if($sql->execute()){

             return "success";
      }else{
    
       return  "error";
      }

      $sql->close();
    }

     public function deleteCategoriasModel($datosModel,$tabla){
      $sql = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idcategoria = :idcategoria");

      $sql->bindParam(':idcategoria', $datosModel, PDO::PARAM_INT);

      if ($sql->execute()) {
         return 'success';
      }else{
        return 'Error';
      }

      $sql->close();
    }


 }