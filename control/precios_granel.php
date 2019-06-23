<?php
include('../conexi.php');
$link = Conectarse();

$id_productos = $_POST['id_productos'];
$respuesta = array();

$consulta = "SELECT * FROM productos LEFT JOIN precios_granel USING(id_productos) WHERE id_productos='$id_productos'";

$result = mysqli_query($link,$consulta);
$num_rows = mysqli_num_rows($result);
while($row = mysqli_fetch_assoc($result)){
	$respuesta['fila'] = $row;
}
if($num_rows > 0){
	$respuesta['estatus'] = 'success';
}else{
	$respuesta['estatus'] = 'error';
	$respuesta['error'] = 'Error en '.$consulta.mysqli_error($link);
}

echo json_encode($respuesta);

?>