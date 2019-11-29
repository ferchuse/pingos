<?php 
include ('../../conexi.php');
$link = Conectarse();

$respuesta = array();

$consulta = "INSERT INTO arqueo SET 

id_usuarios = '{$_COOKIE["id_usuarios"]}',
id_turnos = '{$_COOKIE["id_turnos"]}',
fecha_arqueo = CURDATE(),
hora_arqueo = CURTIME(),
importe = '{$_POST["importe"]}',
`1000` = '{$_POST["1000"]}',
`500` = '{$_POST["500"]}',
`200` = '{$_POST["200"]}',
`100` = '{$_POST["100"]}',
`50` = '{$_POST["50"]}',
`20` = '{$_POST["20"]}',
`10` = '{$_POST["10"]}',
`5` = '{$_POST["5"]}',
`2` = '{$_POST["2"]}',
`1` = '{$_POST["1"]}',
`0.1` = '{$_POST["0.1"]}',
`0.5`= '{$_POST["0.5"]}',
`0.2`	='{$_POST["0.2"]}'

";

if(mysqli_query($link,$consulta)){
	$respuesta['nuevo_id'] = mysqli_insert_id($link);
	$respuesta['estatus'] = "success";
	$respuesta['mensaje'] = "Guardado Correctamente";
}else{
	$respuesta['estatus'] = "error";
	$respuesta['mensaje'] = "Error en ".mysqli_error($link);
}

$respuesta['consulta'] = $consulta;

echo json_encode($respuesta);

?>