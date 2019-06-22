<?php
header("Content-Type: application/json");
include ("../conexi.php");
$link = Conectarse();
$respuesta = Array();


$tabla = $_POST["tabla"];
$arr_pairs = $_POST["valores"];
$str_pairs = "";


//crea un string con los campos y sus valores
foreach($arr_pairs as $arr_field_value){
	if($arr_field_value["value"] == ''){
		$str_pairs.= $arr_field_value["name"]. " = NULL,";
	}
	else{
		$str_pairs.= $arr_field_value["name"]. " = '" . $arr_field_value["value"] . "',";
	}
}

$str_pairs  = trim($str_pairs, ",");

$insert =
"INSERT INTO $tabla SET $str_pairs
		";
		
$resultado = 	mysqli_query($link, $insert);	


$respuesta["consulta"] = "$insert";



if($resultado){
	$respuesta["estatus"] = "success";
	$respuesta["mensaje"] = "Actualizado";
	$respuesta["nuevo_id"] = mysqli_insert_id($link);
	
	$respuesta["query"] = "$insert";
}	
else{
	$respuesta["estatus"] = "error";
	$respuesta["mensaje"] = "Error en update: $insert  ".mysqli_error($link);		
}

echo json_encode($respuesta);
?>