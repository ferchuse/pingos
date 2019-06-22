<?php 
	$consulataGanancia = "SELECT * FROM ventas 
													LEFT JOIN ventas_detalle USING (id_ventas)
													LEFT JOIN productos USING (id_productos)
													WHERE fecha_ventas = CURDATE() AND estatus_ventas = 'PAGADO'
															";
	$resultGanancia = mysqli_query($link,$consulataGanancia);
	
	while($row_Ganancia = mysqli_fetch_assoc($resultGanancia)){
		extract($row_Ganancia);
		$totalGanancia =  array();
		echo var_dump($row_Ganancia);
		if($unidad_contenedora = "PIEZA" == "CAJA"){
			$ganancia = $precio_mayoreo * $ganancia_mayoreo_porc / 100;
			$totalGanancia[] = $ganancia;
			echo array_sum($totalGanancia);
		}else{
			$ganancia = $precio_menudeo * $ganancia_menudeo_porc / 100;
			$totalGanancia[] = $ganancia;
			echo array_sum($totalGanancia);
		}
		
	}
?>