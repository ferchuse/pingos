<?php
header("Content-Type: application/json");
include ("../conexi.php");
$link = Conectarse();
$respuesta = array();

$id_turnos = $_POST['id_turnos'];
$saldo_final = $_POST['saldo_final']; 
$id_usuarios = $_POST['id_usuarios'];

$modificar_turno = "UPDATE turnos  SET fecha_cierre_turnos = CURDATE(), hora_fin = CURTIME(), saldo_final = '$saldo_final', cerrado='1', id_usuarios = '$id_usuarios' WHERE id_turnos = '".$id_turnos."'";
 
// $insertar_turno = "INSERT turnos SET 
			// fecha_inicio_turnos = CURDATE(),
			// hora_inicios = CURTIME()
		// ";
if(mysqli_query($link,$modificar_turno)){
	$respuesta['mensaje_modicar'] = 'success';
}else{
	$respuesta['mensaje_modicar'] = 'error';
	$respuesta['error_modicar'] = "Error en modicar: $modificar_turno  ".mysqli_error($link);	
}
// if(mysqli_query($link,$insertar_turno)){
			// $respuesta['estatus'] = 'success';
		// }else{
			// $respuesta['estatus'] = 'error';
			// $respuesta['mensaje'] = 'Error en Insertar Turno';
		// }


echo json_encode($respuesta);
?>