<?php 
	include("../conexi.php");
	$link = Conectarse();
	
	$id_usuarios = $_POST['id_usuarios'];
	$id_turnos = $_COOKIE['id_turnos'];
	$listaProductos = $_POST['productos'];
	$articulos_ventas = $_POST['articulos_ventas'];
	
	if(isset($_POST['prestamo_ventas'])){
		$prestamo_ventas = $_POST['prestamo_ventas'];
		$estatus = 'PRESTAMO';
		}else{
		$prestamo_ventas = '';
		$estatus = 'PAGADO';
	}
	// $tipo_productos = $_POST['tipo_productos'];
	// $descripcion_productos = $_POST['descripcion_productos'];
	$total = $_POST['total_ventas'];
	
	$insertarVentas = ("INSERT INTO ventas SET
	id_usuarios = '$id_usuarios',
	id_turnos = '$id_turnos',
	fecha_ventas = CURDATE(),
	hora_ventas = CURTIME(),
	total_ventas = '{$_POST["total_ventas"]}',
	articulos_ventas = '$articulos_ventas',
	estatus_ventas = '$estatus',
	efectivo_ventas = '{$_POST["total_ventas"]}'
	");
	$exec_query = mysqli_query($link,$insertarVentas);
	
	if($exec_query){
		$respuesta["estatus_venta"] = "success";
		$respuesta["mensaje_venta"] = "Venta Guardada";
		$respuesta["folio_venta"] = mysqli_insert_id($link);
		
		$id_ventas = mysqli_insert_id($link);
		$respuesta["id_ventas"] = $id_ventas;
		}else{
		$respuesta["estatus_venta"] = "error";
		$respuesta["mensaje_venta"] = "Error en Insertar: $insertarVentas  ".mysqli_error($link);	
		$respuesta["insertarVentas"] = $insertarVentas;
	}
	
	foreach($listaProductos as $indice => $producto){
		 
		$ganancia_pesos = ($producto["precio"] - $producto["costo_proveedor"]) *  $producto["cantidad"];
		$respuesta["ganancia"][] = $ganancia_pesos;
		
		$insertarVentasDetalle = "INSERT INTO ventas_detalle SET
		id_ventas = '$id_ventas',
		id_productos = '$producto[id_productos]',
		unidad_productos = '$producto[unidad_productos]',
		cantidad = '$producto[cantidad]',
		precio = '$producto[precio]',
		importe = '$producto[importe]',
		descripcion = '$producto[descripcion]',
		ganancia = '$ganancia_pesos'
		
		";
		
		$exec_query = mysqli_query($link, $insertarVentasDetalle);
		
		if($exec_query){
			$respuesta['estatus_detalle'] = 'success';
			$respuesta['mensaje_detalle'] = 'Ventas Detalles guardado';
			$id_ventasDetalle = mysqli_insert_id($link);
			}else{
			$respuesta['estatus_detalle'] = 'error';
			$respuesta['mensaje_detalle'] = "Error al guardar Ventas Detalle $insertarVentasDetalle ".mysqli_error($link);
		}
		
		//INSERTA movimientos
		$exist_nueva = $producto["existencia_anterior"] - $producto["cantidad"];
		
		$inserta_movimientos = "INSERT INTO `almacen_movimientos` 
		(`fecha_movimiento`, `tipo_movimiento`, `id_productos`, `cantidad`, `exist_anterior`, `exist_nueva`, `id_usuarios`, `costo`, `id_almacen`, `turno`, `referencia`, `folio`) VALUES (NOW(), 'SALIDA', 
		'{$producto["id_productos"]}', '{$producto["cantidad"]}', '{$producto["existencia_anterior"]}', 
		'$exist_nueva', 
		'$id_usuarios',
		'{$producto["precio"]}', 
		'1', 
		'$turno',   
		'VENTA #$id_ventas', 
		'$id_ventas')";
		
		$result_movimientos = mysqli_query( $link, $inserta_movimientos );
		
		$respuesta["result_movimientos"] = $result_movimientos."-".mysqli_error($link) ;
		
		
		//actualiza existencias
		
		$update_existencia = "UPDATE productos SET existencia_productos = existencia_productos - '{$producto["cantidad"]}'
		WHERE id_productos = '{$producto["id_productos"]}'	"; 
		
		$result_existencia = mysqli_query( $link, $update_existencia );
		
		$respuesta["result_existencia"] = $result_existencia ;
		
		
		
		
	}
	
	echo json_encode($respuesta);
?>