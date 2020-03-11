<?php
/*require_once("../pdf/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

$codigoHTML='
<html>
<head>
<style>
    header,
    footer {
        width: 100%;
        text-align: center;
        position: fixed;
    }
    *{
        font-family:"Helvetica";
    }
    header {
        top: 0px;
    }
    footer {
        left:160px;
        bottom: 80px;
    }
    .mesa{
        width:80%;
        margin-left:10%;
    }
    .contenido{
        margin-top:3em;
        width:100%;
    }
    .caja{
        width:100%;
        height:2em;
        background-color:red;
    }
    table{
        width:100%;
    }
    table {}
</style>
</head>
<body>
    <header>
        <h2>Pedidos Pendientes</h2>
    </header>
    <div class="contenido">
    <div class="mesa">
        <h3>Mesa1</h3>
        <table>
                <tr>
                    <td>#</td>
                    <td>Producto</td>
                    <td>Cantidad</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>COCA COLA 500CM</td>
                    <td>4</td>
                </tr>
        </table>
    </div>

    <div class="mesa">
        <h3>Mesa1</h3>
        <table>
                <tr>
                    <td>#</td>
                    <td>Producto</td>
                    <td>Cantidad</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>COCA COLA 500CM</td>
                    <td>4</td>
                </tr>
        </table>
    </div>

    <div class="mesa">
        <h3>Mesa1</h3>
        <table>
                <tr>
                    <td>#</td>
                    <td>Producto</td>
                    <td>Cantidad</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>COCA COLA 500CM</td>
                    <td>4</td>
                </tr>
        </table>
    </div>
    </div>
</body>
</html>
';
$dompdf= new Dompdf();
$dompdf->loadHtml($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("sample.pdf",array("Attachment"=>0));*/?>
























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
	$rows = $conexion->query("SELECT * FROM $mesa ta JOIN productos pro ON ta.idproducto = pro.idproducto
								JOIN estados_productos EP ON ta.id_estado_producto = EP.id_estado_producto
								WHERE ta.id_estado_producto = 1");

	$detalles = "<table><tr><td>Cantidad</td><td>Nombre Producto</td></tr>";
	$detalles .= "<tr><td colspan='4'>----------------------------------</td></tr>";
	$total = 0;
	foreach($rows as $r){
		$detalles .= "<tr><td>".$r['cantidad']."</td>";
		$detalles .= "<td>".strip_tags($r['nombreproducto'])."</td>";
		$detalles .= "</tr>";
		$total 	  += $r['precio_total_producto'];
	}

#CON FORMATO EN WINDOWS
$salida = "<div id='encabezado'>
Kyung Kyune
Parrillada Coreana
Otazu 1463 c/ Tte.Alcorta, 1604 Asuncion
==================================</div>
Pedido Faltante
Mesa: $mesa
----------------------------------$detalles";
$salida .= "<tr><td colspan='4'>==================================</td></tr>
</table>";

echo nl2br($salida);
