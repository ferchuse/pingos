<?php
	header("Content-Type: application/json");
	include ("../conexi.php");
	$link = Conectarse();
	$respuesta = Array();
	
	
	$guardarProductos = "INSERT INTO productos SET 
	id_productos = '{$_POST["id_productos"]}',
	codigo_productos = '{$_POST["codigo_productos"]}',
	descripcion_productos = '{$_POST["descripcion_productos"]}',
	costo_proveedor = '{$_POST["costo_proveedor"]}',
	costo_mayoreo = '{$_POST["costo_mayoreo"]}',
	piezas = '{$_POST["piezas"]}',
	unidad_productos = '{$_POST["unidad_productos"]}',
	precio_mayoreo = '{$_POST["precio_mayoreo"]}',
	precio_menudeo = '{$_POST["precio_menudeo"]}',
	ganancia_menudeo_porc = '{$_POST["ganancia_menudeo_porc"]}',
	min_productos = '{$_POST["min_productos"]}',
	id_departamentos = '{$_POST["id_departamentos"]}',
	existencia_productos = '{$_POST["existencia_productos"]}'
	
	
	ON DUPLICATE KEY UPDATE 
	
	codigo_productos = '{$_POST["codigo_productos"]}',
	descripcion_productos = '{$_POST["descripcion_productos"]}',
	costo_proveedor = '{$_POST["costo_proveedor"]}',
	costo_mayoreo = '{$_POST["costo_mayoreo"]}',
	piezas = '{$_POST["piezas"]}',
	unidad_productos = '{$_POST["unidad_productos"]}',
	precio_mayoreo = '{$_POST["precio_mayoreo"]}',
	precio_menudeo = '{$_POST["precio_menudeo"]}',
	ganancia_menudeo_porc = '{$_POST["ganancia_menudeo_porc"]}',
	min_productos = '{$_POST["min_productos"]}',
	id_departamentos = '{$_POST["id_departamentos"]}',
	existencia_productos = '{$_POST["existencia_productos"]}'
	
	;
	
	";
	if(mysqli_query($link,$guardarProductos)){
		$respuesta['estatus'] = "success";
		$id_producto = mysqli_insert_id($link);
		}else{
		$respuesta['estatus'] = "error";
		$respuesta['mensaje'] = "Error en ".$guardarProductos.mysqli_error($link);
	}
	
	
	
	echo json_encode($respuesta);
?>