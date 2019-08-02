<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_fin = $_POST['fecha_fin'];
	
	$lista_movimientos = [];
	$entradas = [];
	$salidas = [];
	$departamento = [];
	
	
	
	$consulta_departamento = "SELECT * FROM departamentos WHERE id_departamentos = '{$_POST[id_departamentos]}'";
	
	
	$result = mysqli_query($link,$consulta_departamento) or die ("<pre>Error en $consulta_departamento". mysqli_error($link). "</pre>");
	
	while($fila = mysqli_fetch_assoc($result)){
		
		$departamento[] = $fila;
		
	}	
	
	$consulta_movimientos = "SELECT
	id_productos,
	codigo_productos,
	descripcion_productos,
	nombre_departamentos,
	COALESCE (entradas, 0) AS entradas,
	COALESCE (salidas, 0) AS salidas
	FROM
	productos
	LEFT JOIN departamentos USING(id_departamentos)
	LEFT JOIN (
	SELECT
	id_productos,
	SUM(cantidad) AS entradas
	FROM
	almacen_movimientos 
	WHERE
	DATE(fecha_movimiento) BETWEEN '{$_POST['fecha_inicio']}'
	AND '{$_POST['fecha_fin']}'
	AND tipo_movimiento = 'ENTRADA'
	GROUP BY id_productos
	) AS t_entradas USING (id_productos)
	LEFT JOIN (
	SELECT
	id_productos,
	SUM(cantidad) AS salidas
	FROM
	almacen_movimientos
	WHERE
	DATE(fecha_movimiento) BETWEEN '{$_POST['fecha_inicio']}'
	AND '{$_POST['fecha_fin']}'
	AND tipo_movimiento = 'SALIDA'
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
	
	$consulta_entradas = "SELECT
	id_entradas AS folio,
	fecha_entradas AS fecha_movimiento,
	id_productos,
	codigo_productos,
	cantidad
	FROM
	entradas
	LEFT JOIN entradas_productos USING(id_entradas)
	LEFT JOIN productos USING(id_productos)
	LEFT JOIN departamentos USING(id_departamentos)
	WHERE
	DATE(fecha_entradas) BETWEEN '{$_POST['fecha_inicio']}'
	AND '{$_POST['fecha_fin']}'";
	if($_POST['id_departamentos'] != ''){
		$consulta_entradas .= " AND
		id_departamentos = '{$_POST['id_departamentos']}'";
	}
	$consulta_entradas .= " ORDER BY fecha_entradas";
	
	
	// $result_entradas = mysqli_query($link,$consulta_entradas) or die ("<pre>Error en $consulta_entradas". mysqli_error($link). "</pre>");
	
	while($fila = mysqli_fetch_assoc($result_entradas)){
		
		$entradas[] = $fila;
		
	}
	
	$consulta_salidas = "SELECT
	id_salidas AS folio,
	fecha_salidas AS fecha_movimiento,
	id_productos,
	codigo_productos,
	cantidad
	FROM
	salidas
	LEFT JOIN salidas_productos USING(id_salidas)
	LEFT JOIN productos USING(id_productos)
	LEFT JOIN departamentos USING(id_departamentos)
	WHERE
	DATE(fecha_salidas) BETWEEN '{$_POST['fecha_inicio']}'
	AND '{$_POST['fecha_fin']}'
	AND id_departamentos ={$_POST['id_departamentos']}
	ORDER BY fecha_salidas, id_productos ";
	
	
	// $result_salidas = mysqli_query($link,$consulta_salidas) or die ("<pre>Error en $consulta_salidas". mysqli_error($link). "</pre>");
	
	while($fila = mysqli_fetch_assoc($result_salidas)){
		
		$salidas[] = $fila;
		
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
								<td><?php echo $fila_movimientos["entradas"] == '0.000' ? "-" : $fila_movimientos["entradas"] ;?></td>
								<td><?php echo $fila_movimientos["salidas"] == '0.000' ? "-" : $fila_movimientos["salidas"] ;?></td>
								
							</tr>
							<?php
								
							}
							
						?>
						
						
					</table>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="col-4 hidden">
		<div class="card ">
			<div class="card-header bg-success text-white">
				<h4 class="text-center">
					Entradas
				</h4>
			</div>
			<div class="card-body" >
				<div class="table-responsive">
					
					<table class="table table-hover">
						<tr>
							<th class="text-center">Fecha</th>
							<th class="text-center">Folio</th>
							<th class="text-center">Código</th>
							<th class="text-center">Cantidad</th>                                                         
						</tr>
						<?php 
							$total = 0;
							foreach($entradas AS $i => $fila_entradas){
								$total+=$fila_entradas["cantidad"];
							?>
							<tr class="text-center">
								<td><?php echo date("d/m/Y", strtotime($fila_entradas["fecha_movimiento"]));?></td>
								<td><?php echo $fila_entradas["folio"];?></td>
								<td><?php echo $fila_entradas["codigo_productos"];?></td>
								<td><?php echo $fila_entradas["cantidad"];?></td>
								
							</tr>
							<?php
								
							}
							
						?>
						<tfoot> 
							<tr class="text-center h3">
								<td colspan="2"><b>TOTAL</b></td>
								<td><b><?php echo $total;?></b></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="col-sm-4 hidden">
		<div class="card ">
			<div class="card-header bg-danger text-white">
				<h4 class="text-center">
					Salidas
				</h4>
			</div>
			<div class="card-body" >
				<div class="table-responsive">
					<table class="table table-hover">
						<tr>
							<th class="text-center">Fecha</th>
							<th class="text-center">Código</th>
							<th class="text-center">Cantidad</th>                                                         
						</tr>
						<?php 
							$total = 0;
							foreach($salidas AS $i => $fila_salidas){
								$total+=$fila_salidas["cantidad"];
							?>
							<tr class="text-center">
								<td><?php echo date("d/m/Y", strtotime($fila_salidas["fecha_movimiento"]));?></td>
								<td><?php echo $fila_salidas["codigo_productos"];?></td>
								<td><?php echo $fila_salidas["cantidad"];?></td>
							</tr>
							<?php
								
							}
							
						?>
						<tfoot> 
							<tr class="text-center h3">
								<td colspan="2"><b>TOTAL</b></td>
								<td><b><?php echo $total;?></b></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
}
?>


