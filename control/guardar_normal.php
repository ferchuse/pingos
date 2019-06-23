<?php
header("Content-Type: application/json");
include ("../conexi.php");
$link = Conectarse();
$respuesta = Array();


$tabla = $_POST["tabla"];
$campos_valores = $_POST["datos"];
$str_pairs = "";
if(empty($campos_valores[0]['value'])){
	$query =
	"INSERT INTO $tabla SET ";	

	foreach($campos_valores as $arr_field_value){
		
		$str_pairs.= $arr_field_value["name"]. " = '" . $arr_field_value["value"] . "',";
		
	}

	$str_pairs  = trim($str_pairs, ",");

	$query.= $str_pairs;
}else{
	$query =
	"UPDATE $tabla SET ";	

	foreach($campos_valores as $arr_field_value){
		
		$str_pairs.= $arr_field_value["name"]. " = '" . $arr_field_value["value"] . "',";
		
	}

	$str_pairs  = trim($str_pairs, ",");

	$query.= $str_pairs." WHERE ".$campos_valores[0]['name']."='".$campos_valores[0]['value']."'";
}	
$exec_query = 	mysqli_query($link,$query);


if($exec_query){
	$respuesta["estatus"] = "success";
	$respuesta["mensaje"] = "Agregado";
	$respuesta["query"] = $query;
}	
else{
	$respuesta["estatus"] = "error";
	$respuesta["mensaje"] = "Error en insert: $query  ".mysqli_error($link);		
}

echo json_encode($respuesta);
?>