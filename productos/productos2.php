<?php 
header("Content-Type: application/json");
include('../conexi.php');
$link = Conectarse();
$arrResult = array();
$consulta = "SELECT * FROM productos LEFT JOIN departamentos USING (id_departamentos) WHERE 1";    
if($_GET["id_departamentos"] != '') {        
    $consulta.= " AND  id_departamentos = '{$_GET["id_departamentos"]}'";
}
if($_GET["existencia"] != '') {        
    $consulta.= " AND existencia_productos < min_productos";
} 
//comentario X

$consulta.= " ORDER BY descripcion_productos";
$result = mysqli_query($link,$consulta);
if(!$result){
        die("Error en $consulta" . mysqli_error($link) );
}else{
    $num_rows = mysqli_num_rows($result);
    if($num_rows != 0){
        while($row = mysqli_fetch_assoc($result)){
            $arrResult[] = $row;        

            }
        }else{
    
        }
    }
    echo json_encode($arrResult);
?>
