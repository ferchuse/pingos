<?php 
	include("../../conexi.php");
	$link = Conectarse();
	
	$id_usuarios = $_POST['id_usuarios'];
	$estatus_egresos = $_POST['estatus_egresos'];
	$id_egresos = $_POST['id_egresos'];
	$fecha_cancelacion = date("d/m/Y");
	$hora_cancelacion = date("H:i:s");
	$motivo = $_POST['motivo'];
	
	$cancela_egreso = "UPDATE egresos SET estatus_egresos = '$estatus_egresos' WHERE id_egresos = $id_egresos";
	
	$result_cancela = mysqli_query($link, $cancela_egreso);
	 
	$respuesta["result_cancela"] = $result_cancela;
	$respuesta["mensaje_cancela"] = mysqli_error($link);

?>