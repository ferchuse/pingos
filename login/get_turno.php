<?php
header("Content-Type: application/json");
include("../conexi.php");
$link  = Conectarse();
$respuesta   = array();

$q_turnos = "SELECT * FROM  turnos ORDER BY id_turnos DESC LIMIT 1";

$respuesta["q_turnos"] = "$q_turnos";
$result = mysqli_query($link, $q_turnos);

if(!$result){
	$respuesta["buscar_turno"] = "Error al Buscar Turno: $q_turnos". mysqli_error($link);
}else{
	$num_rows = mysqli_num_rows($result) ;
	$respuesta["num_rows"] = "$num_rows";
	if($num_rows == 0){
		$respuesta["ultimo_turno"] = 1;
		$respuesta["pedir_efectivo"] = 1;
		$respuesta["mensaje"] = "No hay turnos";
		
		$insertar_turno = "INSERT turnos SET 
			fecha_inicio_turnos = CURDATE(),
			hora_inicios = CURTIME()
		";
		if(mysqli_query($link,$insertar_turno)){
			$respuesta['estatus'] = 'success';
		}else{
			$respuesta['estatus'] = 'error';
			$respuesta['mensaje'] = 'Error en Insertar Turno';
		}
	}else{
		$consulta = "SELECT * FROM turnos WHERE cerrado = 0 ";
		$resultado = mysqli_query($link,$consulta);
		$numero_turno_abiertos = mysqli_num_rows($resultado);
		if($numero_turno_abiertos == 0){
			$insertar_nuevo_t = "INSERT INTO turnos SET 
				fecha_inicio_turnos = CURDATE(),
				hora_inicios = CURTIME(), cerrado = 0";
			
			if(mysqli_query($link,$insertar_nuevo_t)){
				$respuesta['estatus'] = "success";
			}else{
				$respuesta['estatus'] = 'error';
				$respuesta['mensaje'] = 'Error en Insertar';
			
			}
			
		}else{
			while($fila = mysqli_fetch_assoc($result)){
			$ultimo_turno = $fila["id_turnos"];
			$cerrado = $fila["cerrado"];
			$respuesta["ultimo_turno"] = "$ultimo_turno";
			$respuesta["cerrado"] = "$cerrado";
			/* $respuesta["efectivo_inicial"] = $fila["efectivo_inicial"]; */
			$respuesta['ultimo_turno'] = $fila['id_turnos'];
			}
			
		}
		
		
	}
}
echo json_encode($respuesta);

?>