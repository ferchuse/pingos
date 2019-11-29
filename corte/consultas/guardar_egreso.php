<?php 
include ('../../conexi.php');
$link = Conectarse();

$respuesta = array();
$descripcion_egresos = $_POST['descripcion_egresos'];
$cantidad_egresos = $_POST['cantidad_egresos'];
$area_egresos = $_POST['area_egresos'];

$consulta = "INSERT INTO egresos SET 
id_catalogo_egresos='{$_POST["id_catalogo_egresos"]}', 
id_turnos='{$_COOKIE["id_turnos"]}', 
descripcion_egresos='$descripcion_egresos', 
cantidad_egresos='$cantidad_egresos', 
area_egresos='$area_egresos',
fecha_egresos=CURDATE(), 
hora_egresos=CURTIME()";

if(mysqli_query($link,$consulta)){
	$respuesta['estatus'] = "success";
}else{
	$respuesta['estatus'] = "error";
	$respuesta['mensaje'] = "Error en ".mysqli_error($link);
}

echo json_encode($respuesta);

?>