<?php
	include("../conexi.php");
	$link = Conectarse();
	
	//Busca la ultima compra PENDIENTE y si existe usa el id de la compra , sino inserta una nueva compra y  asigna el id_compras
    
    //$id_compras = mysqli_insert_id($link)
	
	//consulta el producto enviado por GET
	
	$consulta_producto = "SELECT * FROM productos WHERE id_productos = '{$_GET["id_productos"]}'";
	
	$result = mysqli_query($link, $consulta);
	
	if($result){
		while($fila = mysqli_fetch_assoc($result){

            // asignar producto encontrado a una variable 
		}
	}
	else{
		
		
	}
	
	
	//agrega el producto a la compra_detalle usando el id_compra 
	
?>