<?php 
 $conexion = new PDO('mysql:host=localhost;dbname=restaurant','root','admin');
   date_default_timezone_set('America/Argentina/Buenos_Aires');
 $conexion->exec('SET CHARACTER SET utf8');

 ?>