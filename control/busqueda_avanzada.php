<?php
header("Content-Type: application/json"); 
include('../conexi.php');
$link = Conectarse();
$repuesta = array();

$tabla_principal = $_POST['tabla_principal'];

$consulta = "SELECT * FROM ".$tabla_principal;


if(isset($_POST['joins'])){
	$joins = ""; 
				foreach($_POST["joins"] as $index => $join){
					$joins.= " LEFT JOIN "; 
					$joins.= $join["tabla"];
					
					$joins.= " USING (".$join["using"].") ";
				}
				$consulta .= $joins;
}

if(isset($_POST["filtros"])){
				$filtros = " WHERE "; 
				foreach($_POST["filtros"] as $index => $filtro){
					if( $filtro["operador"] == "="){
						$filtros.= $filtro["campo"] . $filtro["operador"]. "'".$filtro["valor"]."' AND " ;
					}
				}
				$filtros = substr($filtros, 0, -4);
				
				$consulta .= $filtros;
}
$respuesta['consulta'] = $consulta;


$result_complete = mysqli_query($link, $consulta) or die ("Error al ejecutar consulta: $consulta".mysqli_error($link));

$numero_filas = mysqli_num_rows($result_complete);
$contador = 0;

while($fila = mysqli_fetch_assoc($result_complete)){
	$contador++;

	$respuesta["fila"][] = $fila;	
}

$respuesta['numero_filas'] = "$numero_filas";

$respuesta['mensaje'] = $numero_filas < 1 ? "No encontrado":'OK';
$respuesta["encontrado"] =  $numero_filas < 1 ? 0 : 1;

print(json_encode($respuesta));

?>