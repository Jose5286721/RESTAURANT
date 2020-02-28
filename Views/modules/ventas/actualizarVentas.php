<?php  
	require 'Views/modules/ventas/conexion.php';	
ob_start();

 $id = S_POST["idmesa"];
// echo "el id de la mesa es:" .$idmesa;

$sql= Conexion::conectar()->prepare("UPDATE $tabla SET idproducto = :idproducto, 
				 														   idusuario = :idusuario, 
				 														   precio = :precio,
																		   cantidad = :cantidad, 
				 														   precio_total_producto = :precio_total_producto 
				 										WHERE idmesa = '$id'");

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



?>