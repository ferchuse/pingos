<?php
include('../conexi.php');
$link = Conectarse();
$respuesta = array();
$producto = $_POST['producto'];

$consulta = "SELECT codigo_productos FROM productos WHERE codigo_productos='$producto'";
$result = mysqli_query($link,$consulta);
$num_rows = mysqli_num_rows($result);

$respuesta['repetidos'] = $num_rows;

echo json_encode($respuesta);
?>