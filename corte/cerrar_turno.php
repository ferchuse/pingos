<?php
	header("Content-Type: application/json");
	include ("../conexi.php");
	$link = Conectarse();
	$respuesta = array();
	
	//Cierra el turno
	$cerrar_turno = "UPDATE turnos  SET 
	fecha_cierre_turnos = CURDATE(), 
	hora_fin = CURTIME(), 
	saldo_final = '{$_POST['saldo_final']}', 
	cerrado='1', 
	id_usuarios = '{$_POST['id_usuarios']}' 
	WHERE id_turnos = '{$_COOKIE['id_turnos']}'";
	
	$respuesta['cerrar_turno'] = $cerrar_turno;
	
	if(mysqli_query($link,$cerrar_turno)){
		$respuesta['cierra_turno']["estatus"] = 'success';
	}
	else{
		$respuesta['cierra_turno']["estatus"] = 'error';
		$respuesta['cierra_turno']["error"] = mysqli_error($link);	
	}
	
	
	//#Inicia un nuevo turno
	
	// $inicia_turno = "INSERT turnos SET 
	// fecha_inicio_turnos = CURDATE(),
	// hora_inicios = CURTIME()
	// ";
	
	// if(mysqli_query($link,$inicia_turno)){
		// $respuesta['estatus'] = 'success';
		// }
	// else{
		// $respuesta['estatus'] = 'error';
		// $respuesta['mensaje'] = 'Error en Insertar Turno';
	// }
	
	
	echo json_encode($respuesta);
?>