<?php
require_once '../../../Controller/reservasController/reservasController.php';
//require_once '../../../Model/reservasModel/reservasModel.php';
class Conexion{
    public function conectar(){
       try {
          $conexion = new PDO('mysql:host=127.0.0.1;dbname=restaurant','root','admin');
          $conexion->exec('SET CHARACTER SET utf8');
          $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
          return $conexion;
       } catch (Exception $e) {
          echo "ERROR DE CONEXION". $e->getMessage. $e->getLine;
       }
    }
}
class Datos{
  //Realiza la consulta para saber que mesas estan disponibles
  public function getMesasDisponiblesParaReservar($fechaOpcion){
   $fecha = $fechaOpcion;
   //$fecha = date('Y-m-d');
   $sql=Conexion::conectar()->prepare("SELECT b.idmesa,b.nombremesa FROM Mesa b RIGHT join reservas on reservas.idmesa = b.idmesa and reservas.diallegada = "."'".$fecha['fechaOpcion']."'"." and reservas.horallegada BETWEEN '".$fecha['horallegada']."' and '".date("H:i",strtotime("-1 minute",strtotime($fecha['fechaOpcion']." ".$fecha['horasalida'].":00")))."'");
   $sql->execute();
   $mesasOcupadas = $sql->fetchAll();
   return $mesasOcupadas;
   $sql->close();
 }
 //Obtener todas las mesas
 public function getMesas(){
   $sql=Conexion::conectar()->prepare("SELECT idmesa,nombremesa FROM Mesa");
   $sql->execute();
   return $sql->fetchAll();
   $sql->close();
 }
}

if(isset($_GET['fechaOpcion']) && isset($_GET['horallegada']) && isset($_GET['horasalida'])){
    $fechaOpcion = array("horallegada"=>$_GET['horallegada'],"horasalida" => $_GET['horasalida'],"fechaOpcion"=>$_GET['fechaOpcion']);
    $controller = new MvcController();
    $controller->getMesasDisponiblesController($fechaOpcion);
}