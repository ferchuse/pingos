<?php
	header('Content-Type: application/json');
	include("../conexi.php");
	$link=Conectarse();
	
	$respuesta = array();
	$debug = array();
	
	$term = $_GET["term"];
	
	$tabla = $_GET["tabla"];
	$campo = $_GET["campo"];
	
	$query_complete = "SELECT
	id_productos,
	codigo_productos,
	descripcion_productos,
	unidad_contenedora AS unidad_productos,
	cantidad_contenedora AS cantidad_productos,
	precioventa_mayoreo_productos AS precio,
	'MAYOREO' AS tipo_precio
FROM
	productos
WHERE
	descripcion_productos LIKE '%$term%'
	AND costo_productos > 0
	AND cantidad_contenedora > 1
UNION
	SELECT
		id_productos,
		codigo_productos,
		descripcion_productos,
		unidad_productos AS unidad_productos,
		1,
		precioventa_menudeo_productos as precio,
		'MENUDEO' AS tipo_precio
	
	FROM
		productos
	WHERE
		descripcion_productos LIKE '%$term%'
		AND costo_productos > 0
	ORDER BY
		descripcion_productos";
	
	
	
	if(isset($_GET["limit"])){
		$limit = $_GET["limit"];
		$query_complete.= " LIMIT $limit";
		
	}
	else{
		$limit = 10;
		$query_complete.= " LIMIT $limit";
		
	}
	
	
	$result_complete = mysqli_query($link, $query_complete  )
	or die("Error al ejecutar consulta: $query_complete".mysqli_error($link));
	
	$count = 0;
	while($row = mysqli_fetch_assoc($result_complete)) {
		$count++;
		$label = $row[$campo];
		
		$value = $row[$campo];
		
		if($row["tipo_precio"] == "MAYOREO"){
			
			$label = $row["unidad_productos"]." -- ".$row[$campo]." - C/". $row["cantidad_productos"]." ".'---$'.$row['precio'];
			$value= $label;
		}
		else{
			$label =$row["unidad_productos"]. " -- ". $row[$campo] .'---$'. $row['precio'] ;
			$value= $label;
		}
		
		
		
		$fila = array("value" => $value, "label" => $label, "extras" => $row, "campo" => $campo );
	
		
		array_push($respuesta, $fila);
		
	}
	
	if($count == 0 ){
		
		$respuesta[] =  array("value" => "", "label" => "No se encontraron resultados");
	}
	
	echo(json_encode($respuesta)); 
	
	

?>