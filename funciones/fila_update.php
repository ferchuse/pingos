<?php
header("Content-Type: application/json");
include ("../conexi.php");
$link = Conectarse();
$respuesta = Array();


$tabla = $_POST["tabla"];
$arr_pairs = $_POST["valores"];
$id_campo = $_POST["id_campo"];
$id_valor = $_POST["id_valor"];
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

$update =
"UPDATE $tabla SET $str_pairs
		WHERE $id_campo = '$id_valor'
		";
		
$exec_query = 	mysqli_query($link, $update);	

$actualizadas = mysqli_affected_rows($link);

$respuesta["query"] = "$update";

if( $actualizadas == 0){
	$respuesta["estatus"] = "error";
	$respuesta["mensaje"] = "$id_campo no encontrada";	
}

if($exec_query){
	$respuesta["estatus"] = "success";
	$respuesta["mensaje"] = "Actualizado";
	$respuesta["query"] = "$update";
}	
else{
	$respuesta["estatus"] = "error";
	$respuesta["mensaje"] = "Error en update: $update  ".mysqli_error($link);		
}

echo json_encode($respuesta);
?>