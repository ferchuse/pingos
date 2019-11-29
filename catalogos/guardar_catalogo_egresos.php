<?php
    include ('../conexi.php');
    $link = Conectarse();
    $tabla = $_POST["tabla"];
    $id_registro = $_POST["id_campo"];
    $name = $_POST["name"];
    $id_field = 'id_'.$tabla;
    $name_field = 'tipo_egreso';

    // TODO
      // HACER DINAMICO id_ y nombre_ para que se adapte a cualquier TABLA
    
    $query = "INSERT INTO $tabla ($id_field, $name_field) 
    VALUES('$id_registro', '$name')
    ON DUPLICATE KEY UPDATE $name_field = '$name'";
    $result = mysqli_query($link, $query);
   
    if($result){
      echo "Se guardó correctamente";
    }
    else{ 
      die("Error en la consulta $query". mysqli_error($link));		
    }
?>