<?php 
	include("../../conexi.php");
	$link = Conectarse();
	
	$id_usuarios = $_POST['id_usuarios'];
	$id_egresos = $_POST['id_ingresos'];
	$fecha_cancelacion = date("d/m/Y");
	$hora_cancelacion = date("H:i:s");
	$motivo = $_POST['motivo'];
	
	$cancela_egreso = "UPDATE ingresos SET estatus_ingresos= 'CANCELADO' WHERE id_ingresos = '{$_POST["id_registro"]}'";
	
	$result_cancela = mysqli_query($link, $cancela_egreso);
	 
	$respuesta["result_cancela"] = $result_cancela;
	$respuesta["mensaje_cancela"] = mysqli_error($link);

?>