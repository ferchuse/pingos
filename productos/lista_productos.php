<?php 
	// header("Content-Type: application/json");
	include('../conexi.php');
	$link = Conectarse();
	
	$consulta = "SELECT * FROM productos LEFT JOIN departamentos USING (id_departamentos) WHERE 1";    
	if($_GET["id_departamentos"] != '') {        
		$consulta.= " AND  id_departamentos = '{$_GET["id_departamentos"]}'";
	}
	if($_GET["existencia"] != '') {        
		$consulta.= " AND existencia_productos < min_productos";
	} 
	
	
	$consulta.= " ORDER BY descripcion_productos";
	
	
	$result = mysqli_query($link,$consulta);
	
	
	if(!$result){
        die("Error en $consulta" . mysqli_error($link) );
		}else{
		$num_rows = mysqli_num_rows($result);
		if($num_rows != 0){
			while($row = mysqli_fetch_assoc($result)){
				$productos[] = $row;        
				
			}
		}
		else{
			die("Sin Prroductos");
		}
	}
	
	
	foreach($productos AS $index  => $producto) {
		$bgClass = $producto["existencia_productos"] < $producto["min_productos"] ? "bg-danger" : " ";
	?>			
	
	<tr class="<?= $bgClass ?>">
		<td class="text-center"><?= $producto["descripcion_productos"] ?></td>
		<td class="text-center"><?= $producto["nombre_departamentos"] ?> </td>
		<td class="text-center"><?= $producto["costo_proveedor"] ?> </td>
		<td class="text-center"><?= $producto["ganancia_menudeo_porc"] ?> </td>
		<td class="text-center"><?= $producto["precio_menudeo"] ?> </td>
		<td class="text-center"><?= $producto["precio_mayoreo"] ?> </td>                
		<td class="text-center"><?= $producto["min_productos"] ?> </td>
		<td class="text-center"><?= $producto["maximo"] ?> </td>
		<td class="text-center"><?= $producto["existencia_productos"] ?> </td>                
		<td class="text-center">
			<input form='form_imprimir_precios' name="id_productos[]" class="seleccionar" type="checkbox" producto="<?= $producto["id_productos"] ?>">
			<button class="btn btn-warning btn_editar" data-id_producto="<?= $producto["id_productos"] ?>">
				<i class="fa fa-edit"></i>
			</button>
			<button class="btn btn-danger btn_eliminar" data-id_producto="<?= $producto["id_productos"] ?>">
				<i class="fa fa-trash"></i>
			</button>
			<button class="btn btn-success btn_carrito" 
			data-id_productos="<?= $producto["id_productos"] ?>"
			data-descripcion="<?= $producto["descripcion_productos"] ?>"
			data-precio="<?= $producto["costo_proveedor"] ?>"
			data-unidad="<?= $producto["unidad_productos"] ?>"
			>
				<i class="fa fa-cart-plus"></i>
			</button>
			<button class="btn btn-info btn_historial" 
			data-id_productos="<?= $producto["id_productos"] ?>"
			>
				<i class="fa fa-clock"></i>
			</button>
		</td>
	</tr>  
	
	<?php
	}
	
?>