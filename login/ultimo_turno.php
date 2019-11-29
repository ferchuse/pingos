<?php
	header("Content-Type: application/json");
	include("../conexi.php");
	$link  = Conectarse();
	$respuesta   = array();
	
	
	//Buscar Ultimo Turno
	$q_turnos = "SELECT * FROM  turnos ORDER BY id_turnos DESC LIMIT 1";
	
	$respuesta["q_turnos"] = "$q_turnos";
	$result = mysqli_query($link, $q_turnos);
	
	
	
	if(!$result){
		$respuesta["buscar_turno"] = "Error al Buscar Turno: $q_turnos". mysqli_error($link);
	}
	else{
		$respuesta["fila_ultimo_turno"] = mysqli_fetch_assoc($result);
		$respuesta["ultimo_turno"] = $respuesta["fila_ultimo_turno"]["id_turnos"];
		$num_rows = mysqli_num_rows($result) ;
		$respuesta["num_rows"] = $num_rows;
		
		//Si no hay turno  o  si el ultimo turno esta cerrado iniciar nuevo turno
		// if($num_rows == 0 or $respuesta["fila_ultimo_turno"]["cerrado"] == "1"){
		
		
		
		// $insertar_turno = "INSERT turnos SET 
		// fecha_inicio_turnos = CURDATE(),
		// hora_inicios = CURTIME()
		// ";
		// if(mysqli_query($link,$insertar_turno)){
		// $respuesta['estatus'] = 'success';
		// $respuesta["pedir_efectivo"] = 1;
		// $respuesta["mensaje"] = "Inserta turno";
		// $respuesta["ultimo_turno"] = mysqli_insert_id($link);
		// $respuesta["cerrad0"] = 0;
		// }
		// else{
		// $respuesta['estatus'] = 'error';
		// $respuesta['mensaje'] = 'Error en Insertar Turno';
		// }
		// }
		// else{
		//Si hay turno checar si esta cerrado
		$consulta = "SELECT * FROM turnos WHERE cerrado = 0  ORDER BY id_turnos DESC LIMIT 1";
		$resultado = mysqli_query($link,$consulta);
		$numero_turno_abiertos = mysqli_num_rows($resultado);
		$respuesta['numero_turno_abiertos'] = $numero_turno_abiertos;
		//Si el turno esta cerrado abrir uno nuevo
		if($numero_turno_abiertos == 0){
			
			
			$insertar_nuevo_t = "INSERT INTO turnos SET 
			fecha_inicio_turnos = CURDATE(),
			efectivo_inicial = '{$_POST["efectivo_inicial"]}',
			hora_inicios = CURTIME(), cerrado = 0";
			
			if(mysqli_query($link,$insertar_nuevo_t)){
				$respuesta['estatus'] = "success";
				$respuesta["pedir_efectivo"] = 1;
			}
			else{
				$respuesta['estatus'] = 'error';
				$respuesta['mensaje'] = 'Error en Insertar';
				
			}
			
		}
		else{
			while($fila = mysqli_fetch_assoc($result)){
				$respuesta["ultimo_turno"] = $fila["id_turnos"];
				$respuesta["cerrado"] = $fila["cerrado"];
				$respuesta["efectivo_inicial"] = $fila["efectivo_inicial"]; 
			}
			
		}
		
		
		// }
	}
	echo json_encode($respuesta);
	
?>