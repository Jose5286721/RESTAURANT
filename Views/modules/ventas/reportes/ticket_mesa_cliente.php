<script>
	window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
    window.print()
</script>
<style>
	#encabezado{width:265px;text-align:center}
	body{width: 265px; font: 13px "Courier New"}
	table{width:265px;font:13px "Courier New"}
	.precio{text-align:right}
</style>
<?php
	require_once '../../../../Model/conexion.php';
	$conexion = Conexion::conectar();
	$mesa = $_GET['mesa'];
	$rows = $conexion->query("SELECT * FROM $mesa ta JOIN productos pro ON ta.idproducto = pro.idproducto  where ta.id_estado_producto != 2");

	$detalles = "<table><tr><td>Cantidad</td><td>Precio Unit.</td><td>Concepto</td><td class='precio'>Monto</td></tr>";
	$detalles .= "<tr><td colspan='4'>----------------------------------</td></tr>";
	$total = 0;
	foreach($rows as $r){
		$detalles .= "<tr><td>".$r['cantidad']."</td><td>".number_format($r['precio'], 0, ',', '.')."</td>";
		$detalles .= "<td>".strip_tags($r['nombreproducto'])."</td>";
		$detalles .= "<td class='precio'>Gs. ".number_format($r['precio_total_producto'], 0, ',', '.')."</td>";
		$detalles .= "</tr>";
		$total 	  += $r['precio_total_producto'];
	}

#CON FORMATO EN WINDOWS
$salida = "<div id='encabezado'>
Kyung Kyune
Parrillada Coreana
Otazu 1463 c/ Tte.Alcorta, 1604 Asuncion
==================================</div>
Ticket Nro.: 001-001-256
Fecha: ".date("d/m/Y H:i:s")."
Cliente: Casual
R.U.C/C.I.: 800XXXXX-X
----------------------------------$detalles";
$salida .= "<tr><td colspan='4'>==================================</td></tr>
<tr><td colspan='2'>TOTAL :</td><td> </td><td class='precio'>Gs.".number_format($total, 0, ',', '.')."</td></tr></table>";

echo nl2br($salida);


$id_estado_producto = 2;
$search = 0;
$sql= $conexion->prepare("UPDATE $mesa SET 
                                  id_estado_producto = :id_estado_producto 
                          WHERE id_estado_producto = $search");
$sql->bindParam(':id_estado_producto',$id_estado_producto, PDO::PARAM_INT);
$sql->execute();