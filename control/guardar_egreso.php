<?php 
include ('../conexi.php');
$link = Conectarse();

$respuesta = array();
$descripcion_egresos = $_POST['descripcion_egresos'];
$cantidad_egresos = $_POST['cantidad_egresos'];
$area_egresos = $_POST['area_egresos'];

$consulta = "INSERT INTO egresos SET descripcion_egresos='$descripcion_egresos', cantidad_egresos='$cantidad_egresos', area_egresos='$area_egresos',
fecha_egresos=CURDATE(), hora_egresos=CURTIME()";

if(mysqli_query($link,$consulta)){
	$respuesta['estatus'] = "success";
}else{
	$respuesta['estatus'] = "error";
	$respuesta['mensaje'] = "Error en ".mysqli_query($link);
}

echo json_encode($respuesta);

?>