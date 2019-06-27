<?php
	include("../conexi.php");
	$link = Conectarse();
		
	$query = "SELECT * FROM compras WHERE estatus_compras='PENDIENTE' ";
	$result = mysqli_query($link, $query);
	$id_compras;
	$respuesta = new array();
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			while ($fila = mysqli_fetch_assoc($result)) {
				$id_compra = $fila['id_compras'];
			}
		} else {
			$query = "INSERT INTO compras SET fecha_compras=now(), estatus_compra='PENDIENTE', id_usuarios={$_COOKIE['id_usuarios']};";
			$result  = mysqli_query($link, $query);
			$id_compra = mysqli_insert_id($link);
			
		}	
		$respuesta['id_compra'] = $id_compra;	
	}

	echo json_encode($respuesta);







	//Busca la ultima compra PENDIENTE y si existe usa el id de la compra , sino inserta una nueva compra y  asigna el id_compras
    
    //$id_compras = mysqli_insert_id($link)
	
	//agregar producto (_POST) a compras detalle 
	
	

?>