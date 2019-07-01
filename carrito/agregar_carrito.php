<?php
	include("../conexi.php");
	$link = Conectarse();
			//Busca la ultima compra PENDIENTE y si existe usa el id de la compra , sino inserta una nueva compra y  asigna el id_compras

	$query = "SELECT * FROM compras WHERE estatus_compras='PENDIENTE' ";
	$result = mysqli_query($link, $query);
	$id_compras;
	$producto = ["id_productos" => "19", "cantidad_productos" => "5", "precio" => "25", "importe" => "125", "descripcion" => "Gomitas" ];
		
	

	$respuesta = array();
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			while ($fila = mysqli_fetch_assoc($result)) {
				$id_compra = $fila['id_compras'];
			}
		} else {
			$query = "INSERT INTO compras SET fecha_compras=now(), estatus_compras='PENDIENTE', id_usuarios={$_COOKIE['id_usuarios']};";
			$result  = mysqli_query($link, $query);
			$id_compra = mysqli_insert_id($link);
			
		}	
		$respuesta['id_compra'] = $id_compra;	
	}


	$consulta_compras_detalle = "INSERT INTO compras_detalle SET id_compras='{$id_compra}', id_producto='{$producto["id_productos"]}',
	precio='{$producto["precio"]}', cantidad='{$producto["cantidad_productos"]}', importe='{$producto["importe"]}', descripcion='{$producto["descripcion"]}'; ";

		
	echo json_encode($respuesta);


    
    //$id_compras = mysqli_insert_id($link)
	
	//agregar producto (_POST) a compras detalle 
	
	

?>