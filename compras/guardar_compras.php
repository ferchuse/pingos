<?php 
	include("../conexi.php");
	$link = Conectarse();
	
	
	$id_turnos = $_POST['id_turnos'];
	$listaProductos = $_POST['productos'];
	
	$estatus_compras = $_POST["entrada_inventario"] ? "FINALIZADA" :  "PENDIENTE";
	
	$insertar = "INSERT INTO compras SET
	id_compras = '{$_POST["id_compras"]}',
	id_usuarios = '{$_POST['id_usuarios']}',
	fecha_compras = NOW(),
	total_compras = '{$_POST["total"]}',
	estatus_compras = '$estatus_compras',
	id_proveedores = '{$_POST["id_proveedores"]}'
	
	ON DUPLICATE KEY UPDATE
	
	id_usuarios = '{$_POST['id_usuarios']}',
	fecha_compras = NOW(),
	total_compras = '{$_POST["total"]}',
	id_proveedores = '{$_POST["id_proveedores"]}',
	estatus_compras = '$estatus_compras'
	";
	
	$exec_query = mysqli_query($link,$insertar);
	
	$respuesta["insertar"] = $insertar;
	
	if($exec_query){
		$respuesta["estatus_venta"] = "success";
		$respuesta["mensaje_venta"] = "Venta Guardada";
		$respuesta["folio_venta"] = mysqli_insert_id($link);
		
		$id_ventas = mysqli_insert_id($link);
		$respuesta["id_ventas"] = $id_ventas;
	}
	else{
		$respuesta["estatus_venta"] = "error";
		$respuesta["mensaje_venta"] = "Error en Insertar: $insertar  ".mysqli_error($link);	
		
	}
	
	
	//Borrar compras detalle anterior
	
	
	$consulta = "DELETE FROM compras_detalle WHERE id_compras = {$_POST["id_compras"]}";
	
	$result = mysqli_query($link,$consulta);
	
	
	if($result){
		$respuesta["estatus_borrar"] = "success";
		$respuesta["mensaje_borrar"] = "Compras detalle borrado";
	}
	else{
		$respuesta["estatus_borrar"] = "error";
		$respuesta["mensaje_borrar"] = "Error en  $consulta  ".mysqli_error($link);	
		
	}
	
	//Inserta productos en compras_detalle
	
	foreach($listaProductos as $indice => $producto){
		$insertarVentasDetalle = "INSERT INTO compras_detalle SET
		id_compras = '$id_ventas',
		id_productos = '$producto[id_productos]',
		unidad_productos = '$producto[unidad_productos]',
		cantidad = '$producto[cantidad]',
		precio = '$producto[precio]',
		descripcion = '$producto[descripcion]',
		importe = '$producto[importe]'
		";
		
		$exec_query = mysqli_query($link, $insertarVentasDetalle);
		
		if($exec_query){
			$respuesta['estatus_detalle'] = 'success';
			$respuesta['mensaje_detalle'] = 'Compra Detalle guardado';
			$id_compras = mysqli_insert_id($link);
			}else{
			$respuesta['estatus_detalle'] = 'error';
			$respuesta['mensaje_detalle'] = "Error al guardar Ventas Detalle $insertarVentasDetalle ".mysqli_error($link);
		}
		
		//INSERTA movimientos
		$exist_nueva = $producto["existencia_anterior"] + $producto["cantidad"];
		
		$inserta_movimientos = "INSERT INTO `almacen_movimientos` 
		(`fecha_movimiento`, `tipo_movimiento`, `id_productos`, `cantidad`, `exist_anterior`, `exist_nueva`, `id_usuarios`, `costo`, `id_almacen`, `turno`, `referencia`, `folio`) VALUES (NOW(), 'ENTRADA', 
		'{$producto["id_productos"]}', '{$producto["cantidad"]}', '{$producto["existencia_anterior"]}', 
		'$exist_nueva', 
		'$id_usuarios',
		'{$producto["precio"]}', 
		'1', 
		'$turno',   
		'COMPRA #$id_compras', 
		'$id_compras')";
		
		$result_movimientos = mysqli_query( $link, $inserta_movimientos );
		
		$respuesta["result_movimientos"] = $result_movimientos."-".mysqli_error($link) ;
		
		
		//actualiza existencias solo si se activa casilla de entrada a inventarios
		
		if($_POST["entrada_inventario"]){
			$update_existencia = "UPDATE productos SET existencia_productos = existencia_productos + '{$producto["cantidad"]}'
			WHERE id_productos = '{$producto["id_productos"]}'	"; 
			
			$result_existencia = mysqli_query( $link, $update_existencia );
			
			$respuesta["result_existencia"] = $result_existencia ;
		}
		
	}
	
	echo json_encode($respuesta);
?>