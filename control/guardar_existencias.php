<?php 
	include("../conexi.php");
	$link = Conectarse();
	
	$id_productos = $_POST['id_productos'];
	$fecha_movimiento = $_POST['fecha_movimiento'];
	$existencia_anterior = $_POST['existencia_anterior'];
	$cantidad_contenedora = $_POST['cantidad_contenedora'];
	$cantidad = $_POST['cantidad_entrada'];
	$tipo_movimiento = $_POST['tipo_movimiento'];
	
	switch($tipo_movimiento){
			case "ENTRADA": 
				$existencia_nueva = $existencia_anterior + $cantidad ;
				
			break;	
			case "SALIDA": 
				$existencia_nueva = $existencia_anterior - $cantidad ;
	
			break;
	}
	
	
	$existencia_unitaria = $existencia_nueva * $cantidad_contenedora;
	
	$insertar_movimiento = "INSERT INTO almacen_movimientos SET
				
				fecha_movimiento ='$fecha_movimiento',
				hora_movimiento = CURTIME(),
				tipo_movimiento = '$tipo_movimiento',
				id_productos = '$id_productos',
				cantidad = '$cantidad',
				exist_anterior = '$existencia_anterior',
				exist_nueva = '$existencia_nueva'
				";
	$exec_query = mysqli_query($link,$insertar_movimiento);
	
	if($exec_query){
		$respuesta["estatus_movimiento"] = "success";
		$respuesta["mensaje_movimiento"] = "Existencia Actualizada";
		
	}else{
		$respuesta["estatus_movimiento"] = "error";
		$respuesta["mensaje_movimiento"] = "Error en Insertar: $insertar_movimiento  ".mysqli_error($link);	
		
	}
	
	$update_existencia = "UPDATE productos SET
				existentes_contenedores = '$existencia_nueva',
				existencia_productos = '$existencia_unitaria'
				WHERE id_productos = '$id_productos'
				";
	$exec_query = mysqli_query($link,$update_existencia);
	
	if($exec_query){
		$respuesta["estatus_update"] = "success";
		$respuesta["mensaje_update"] = "Existencia Actualizada";
		
	}else{
		$respuesta["estatus_update"] = "error";
		$respuesta["mensaje_update"] = "Error en Update: $update_existencia  ".mysqli_error($link);	
		
	}
	
	if($respuesta["estatus_update"] == $respuesta["estatus_movimiento"]){
		$respuesta["estatus"] = "success";
		$respuesta["mensaje"] = "Existencia Actualizada";
		$respuesta["existencia_nueva"] = $existencia_nueva;
	}else{
		$respuesta["estatus"] = "error";
		$respuesta["mensaje"] = ":( Ocurrió un error";
	}
	
		
	echo json_encode($respuesta);
?>