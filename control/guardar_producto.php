<?php
	header("Content-Type: application/json");
	include ("../conexi.php");
	$link = Conectarse();
	$respuesta = Array();
	
	$codigo_productos = $_POST['codigo_productos'];
	$descripcion_productos = $_POST['descripcion_productos'];
	$costo_unitario = $_POST['costo_unitario'];
	$costo_proveedor = $_POST['costo_proveedor'];
	$unidad_productos = $_POST['unidad_productos'];
	$unidad_contenedora = $_POST['unidad_contenedora'];
	$cantidad_contenedora = $_POST['cantidad_contenedora'];
	$ganancia_mayoreo_porc = $_POST['ganancia_mayoreo_porc'];
	$ganancia_mayoreo_pesos = $_POST['ganancia_mayoreo_pesos'];
	$precio_mayoreo = $_POST['precio_mayoreo'];
	$ganancia_menudeo_porc = $_POST['ganancia_menudeo_porc'];
	$ganancia_menudeo_pesos = $_POST['ganancia_menudeo_pesos'];
	$precio_menudeo = $_POST['precio_menudeo'];
	$existencia_productos = $_POST['existencia_productos'];
	$existentes_contenedores = $_POST['existentes_contenedores'];
	
	$guardarProductos = "INSERT INTO productos SET 
	id_productos = '{$_POST["id_productos"]}',
	codigo_productos = '$codigo_productos',
	descripcion_productos = '$descripcion_productos',
	costo_proveedor = '$costo_proveedor',
	unidad_productos = '$unidad_productos',
	precio_mayoreo = '$precio_mayoreo',
	ganancia_menudeo_porc = '$ganancia_menudeo_porc',
	min_productos = '{$_POST["min_productos"]}',
	precio_menudeo = '$precio_menudeo',
	id_departamentos = '{$_POST["id_departamentos"]}',
	existencia_productos = '$existencia_productos'
	
	ON DUPLICATE KEY UPDATE 
	
	codigo_productos = '$codigo_productos',
	descripcion_productos = '$descripcion_productos',
	costo_proveedor = '$costo_proveedor',
	unidad_productos = '$unidad_productos',
	precio_mayoreo = '$precio_mayoreo',
	ganancia_menudeo_porc = '$ganancia_menudeo_porc',
	min_productos = '{$_POST["min_productos"]}',
	precio_menudeo = '$precio_menudeo',
	id_departamentos = '{$_POST["id_departamentos"]}',
	existencia_productos = '$existencia_productos'
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