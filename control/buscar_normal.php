<?php
header("Content-Type: application/json"); 
include('../conexi.php');
$link = Conectarse();
$repuesta = array();

$campo = $_POST['campo'];
$tabla = $_POST['tabla'];
$id_campo = $_POST['id_campo'];

$consulta = "SELECT * FROM $tabla WHERE $campo= '$id_campo'";

$mensaje_error = 'no encontrado';

$result_complete = mysqli_query($link, $consulta)
or die ("Error al ejecutar consulta: $consulta".mysqli_error($link));

$numero_filas = mysqli_num_rows($result_complete);
$contador = 0;

while($fila = mysqli_fetch_assoc($result_complete)){
	$contador++;

	$respuesta["fila"] = $fila;	
}

$respuesta['numero_filas'] = "$numero_filas";

$respuesta['mensaje'] = $numero_filas < 1 ? $mensaje_error:'OK';
$respuesta["encontrado"] =  $numero_filas < 1 ? 0 : 1;
$respuesta['consulta'] = $consulta;

print(json_encode($respuesta));

?>