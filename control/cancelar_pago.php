<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$respuesta = array();
	
	$id_ventas = $_POST['id_ventas'];
	$id_usuarios = $_POST['id_usuarios'];
	$motivo = $_POST['motivo'];

	$consulta = "UPDATE ventas
	SET estatus_ventas = 'CANCELADO',
	motivocancelacion_ventas = '$motivo'
	WHERE
		id_ventas = '$id_ventas'";
		
	if(mysqli_query($link,$consulta)){
		$respuesta['estatus'] = 'success';
	}else{
		$respuesta['estatus'] = 'error';
		$respuesta['error'] = "Error en la DB $consulta ".mysqli_error($link);
	}
	
	echo json_encode($respuesta);
?>