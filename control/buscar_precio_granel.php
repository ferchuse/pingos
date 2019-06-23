<?php
	include('../conexi.php');
	$link = Conectarse();
	
	$tabla_granel = array();
	$id_productos = $_POST['id_campo'];
	$consulta = "SELECT * FROM precios_granel WHERE id_productos='$id_productos'";
	$result = mysqli_query($link,$consulta);
	while($row = mysqli_fetch_assoc($result)){
		$tabla_granel[] = $row;
	}

	echo json_encode($tabla_granel);
?>