<?php 

include("../conexi.php");
$link = Conectarse();

$respuesta = [];

$consulta = "UPDATE productos RIGHT JOIN compras_detalle USING (id_productos) SET existencia_productos =  existencia_productos - compras_detalle.cantidad WHERE id_compras= '{$_GET['id_compras']}'";

if (mysqli_query($link, $consulta)) {
    $respuesta["estatus"] = "OK";
    $respuesta["mensaje"] = "Compra Cancelada";
}
else {
    $respuesta["estatus"] = "Error";
    $respuesta["mensaje"] =  mysqli_error($link);

}
$respuesta["consulta"] = $consulta;

echo (json_encode($respuesta));
?>