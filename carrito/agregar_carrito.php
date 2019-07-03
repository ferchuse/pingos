<?php
	include("../conexi.php");
	$link = Conectarse();
	
	$query = "SELECT * FROM compras WHERE estatus_compras='PENDIENTE' ";
	$result = mysqli_query($link, $query);
	$id_compras;
	$respuesta = [];
	
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			while ($fila = mysqli_fetch_assoc($result)) {
				$id_compras = $fila['id_compras'];
			}
			} else {
			$query = "INSERT INTO compras SET fecha_compras=now(), estatus_compras='PENDIENTE', id_usuarios={$_COOKIE['id_usuarios']};";
			$result  = mysqli_query($link, $query);
			
			if($result){
				
				$id_compras = mysqli_insert_id($link);
				
			}
			else{
				
				$respuesta['error'] = $query . mysqli_error($link);	
			}
			
		}	
		$respuesta['id_compras'] = $id_compras;	
	}
	
	// Inserta producto a Productos Detalle	
	
	$insert_detalle = "INSERT INTO compras_detalle SET 
	id_compras = '$id_compras',
	id_productos = '{$_POST["id_productos"]}',
	unidad_productos = '{$_POST["unidad"]}',
	cantidad = '{$_POST["cantidad"]}',
	descripcion= '{$_POST["descripcion"]}',
	precio='{$_POST["precio"]}',
	importe= '{$_POST["importe"]}' ";
	
	$result  = mysqli_query($link, $insert_detalle);
	
	$respuesta["insert_detalle"] = $result ;
	echo json_encode($respuesta);
	
	
	
	
?>