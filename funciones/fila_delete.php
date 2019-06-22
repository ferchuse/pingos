<?php 
header("Content-Type: application/json");
include('../conexi.php');
$link = Conectarse();

$respuesta = array();

$tabla = $_POST['tabla'];

$id_campo = $_POST['id_campo'];
$id_valor = $_POST['id_valor'];

$consulta = "DELETE  FROM $tabla WHERE $id_campo='$id_valor'";

if(mysqli_query($link,$consulta)){
	$respuesta['estatus'] = 'success';
}else{
	$respuesta['estatus'] = 'error';
	$respuesta['error'] = 'Error en DB'.mysqli_error($link);
}

echo json_encode($respuesta);
?>