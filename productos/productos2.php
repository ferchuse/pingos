<?php 
include('../conexi.php');
$link = Conectarse();
?>

<?php
    $arrResult = array();
    $consulta = "SELECT * FROM productos LEFT JOIN departamentos USING (id_departamentos) WHERE 1";    
    if($_GET["id_departamentos"] != '') {        
        $consulta.= " AND  id_departamentos = '{$_GET["id_departamentos"]}'";
    }
    if($_GET["existencia"] != '') {        
        $consulta.= " AND existencia_productos < min_productos";
    }
    
    $result = mysqli_query($link,$consulta);
    if(!$result){
            die("Error en $consulta" . mysqli_error($link) );
    }else{
        $num_rows = mysqli_num_rows($result);
        if($num_rows != 0){
            while($row = mysqli_fetch_assoc($result)){
                $arrResult[] = $row;        
?>                
		<?php
				}
			}else{
		?>
	
		<?php
			}
        }
        echo json_encode($arrResult);
		?>
	



