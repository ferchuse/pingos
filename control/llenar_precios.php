<?php
include('../conexi.php');
$link = Conectarse();
$tipos_precios = array(0=>array(
"tipo_precios" =>"0-100 gr",
"ganancia_porc" => ".4",
"limite_sup"=>"100",
"limite_inferior"=>"0"
),
1=>array(
"tipo_precios" =>"100-250 gr",
"ganancia_porc" => ".3",
"limite_sup"=>"250",
"limite_inferior"=>"100"),
2=>array(
"tipo_precios" =>"250-500 gr",
"ganancia_porc" => ".2",
"limite_sup"=>"500",
"limite_inferior"=>"250"),
3=>array(
"tipo_precios" =>"500gr - 1kl",
"ganancia_porc" => ".1",
"limite_sup"=>"1000",
"limite_inferior"=>"500"));

$consulta_kg = "SELECT * FROM productos WHERE unidad_productos='KG'";

$result = mysqli_query($link,$consulta_kg);

while($row = mysqli_fetch_assoc($result)){
	extract($row);
	echo $id_productos;
	foreach($tipos_precios as $index => $precio){
		$guardar_granel = "INSERT INTO precios_granel SET id_productos='$id_productos', tipo_precio='".$precio['tipo_precios']."', ganancia_porc='".$precio['ganancia_porc']."', limite_sup='".$precio['limite_sup']."', limite_inferior='".$precio['limite_inferior']."' ";
			if(mysqli_query($link,$guardar_granel)){
				echo 'Success';
			}
			
			
	}
}

?>