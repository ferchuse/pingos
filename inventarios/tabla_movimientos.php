<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_fin = $_POST['fecha_fin'];
	
	$lista_movimientos = [];
	$entradas = [];
	$salidas = [];
	$departamento = [];
	
	
	
	// $consulta_departamento = "SELECT * FROM departamentos WHERE id_departamentos = '{$_POST["id_departamentos"]}'";
	
	
	// $result = mysqli_query($link,$consulta_departamento) or die ("<pre>Error en $consulta_departamento". mysqli_error($link). "</pre>");
	
	// while($fila = mysqli_fetch_assoc($result)){
		
		// $departamento[] = $fila;
		
	// }	
	
	$consulta_movimientos = "SELECT
	id_productos,
	codigo_productos,
	descripcion_productos,
	unidad_productos,
	nombre_departamentos,
	COALESCE (entradas, 0) AS entradas,
	COALESCE (salidas, 0) AS salidas
	FROM
	productos
	LEFT JOIN departamentos USING(id_departamentos)
	
	##Entradas por compras
	
	LEFT JOIN (
	SELECT
	id_productos,
	SUM(cantidad) AS entradas
	FROM
	compras_detalle  
	LEFT JOIN 
	compras USING (id_compras)
	WHERE
	DATE(fecha_compras) BETWEEN '{$_POST['fecha_inicio']}'
	AND '{$_POST['fecha_fin']}'
	AND estatus_compras = 'FINALIZADA'
	GROUP BY id_productos
	) AS t_entradas USING (id_productos)
	
	##Salidas por Ventas
	
	LEFT JOIN (
	SELECT
	id_productos,
	
	SUM(cantidad) AS salidas
	FROM
	ventas_detalle 
	LEFT JOIN  ventas USING (id_ventas)
	WHERE
	DATE(fecha_ventas) BETWEEN '{$_POST['fecha_inicio']}'
	AND '{$_POST['fecha_fin']}'
	AND estatus_ventas= 'PAGADO'
	GROUP BY id_productos
	) AS t_salidas USING (id_productos)
	WHERE 1";
	
	if($_POST['id_departamentos'] != ''){
		$consulta_movimientos .= "
		AND
		id_departamentos = '{$_POST['id_departamentos']}'";
	}
	if($_POST['id_productos'] != ''){
		$consulta_movimientos .= "
		AND
		id_productos ='{$_POST['id_productos']}'";
	}
	
	$consulta_movimientos .= " ORDER BY
	{$_POST['sort']} DESC";
	
	
	$result_movimientos = mysqli_query($link,$consulta_movimientos) or die ("<pre>Error en $consulta_movimientos". mysqli_error($link). "</pre>");
	
	while($fila = mysqli_fetch_assoc($result_movimientos)){
		
		$lista_movimientos[] = $fila;
		
	}
	
?>

<pre class="hidden">
	<?php echo $consulta_movimientos;?>
</pre>
<?php 
	if(mysqli_num_rows($result_movimientos) < 1){
	?>
	<br>
	
	<div class="alert alert-warning text-center">
		<strong>No hay registros</strong> 
	</div>
	<?php		
	}
	else{
	?>
	
	
	<div class="col-4">
		<div class="card ">
			<div class="card-header bg-info text-white">
				<h4 class="text-center">
					Movimientos <?php echo $lista_movimientos[0]["nombre_departamentos"];?>
				</h4>
			</div>
			<div class="card-body" >
				<div class="table-responsive">
					
					<table class="table table-hover">
						<tr>
							<th class="text-center">
								<a href="#" class="sort" data-campo="descripcion_productos">Descripción</a>
							</th>
							<th class="text-center">
								Unidad
							</th>
							<th class="text-center">
								<a href="#" class="sort" data-campo="entradas">Entradas</a>
							</th>
							<th class="text-center">
								<a href="#" class="sort" data-campo="salidas">Salidas</a>
							</th>							
						</tr>
						<?php 
							
							foreach($lista_movimientos AS $i => $fila_movimientos){
							?>
							<tr class="text-center">
								
								<td><?php echo $fila_movimientos["descripcion_productos"];?></td>
								<td><?php echo $fila_movimientos["unidad_productos"];?></td>
								<td>
									<?php 
										if($fila_movimientos["unidad_productos"] == "KG"){
											
											echo number_format($fila_movimientos["entradas"],3);
										}
										else{
											echo number_format($fila_movimientos["entradas"]);
										}
										
										// echo $fila_movimientos["entradas"] == '0.000' ? "-" : $fila_movimientos["entradas"] ;
									?>
								</td>
								<td>
									<?php 
										if($fila_movimientos["unidad_productos"] == "KG"){
											
											echo number_format($fila_movimientos["salidas"],3);
										}
										else{
											echo number_format($fila_movimientos["salidas"]);
										}
										
										// echo $fila_movimientos["entradas"] == '0.000' ? "-" : $fila_movimientos["entradas"] ;
									?>
								</td>
								
								
							</tr>
							<?php
								
							}
							
						?>
						
						
					</table>
				</div>
			</div>
		</div>
	</div>
	
	
	
</div>

<?php 
}
?>


