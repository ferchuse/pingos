<?php 
header("Content-Type: application/json");
include('../conexi.php');
$link = Conectarse();

$respuesta = array();

$campo = $_POST['campo'];
$tabla = $_POST['tabla'];
$id_campo = $_POST['id_campo'];

$consulta = "DELETE  FROM $tabla WHERE $campo='$id_campo'";

if(mysqli_query($link,$consulta)){
	$respuesta['estatus'] = 'success';
}else{
	$respuesta['estatus'] = 'error';
	$respuesta['error'] = 'Error en DB'.mysqli_error($link);
}

echo json_encode($respuesta);
?>