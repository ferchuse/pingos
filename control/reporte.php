<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	
	$consultaVentas = "
	SELECT
	*
	FROM
	(
	SELECT
	fecha_ventas,
	COALESCE (SUM(total_ventas), 0) AS ventas_dia
	FROM
	ventas
	WHERE
	estatus_ventas <> 'CANCELADO'
	AND fecha_ventas BETWEEN '{$_GET["fecha_inicio"]}'
	AND '{$_GET["fecha_fin"]}'
	GROUP BY
	fecha_ventas
	) AS ventas_dia
	
	LEFT JOIN
	(
	SELECT
	fecha_ventas,
	COUNT(*) as num_ventas
	FROM
	ventas
	WHERE
	estatus_ventas <> 'CANCELADO'
	AND fecha_ventas BETWEEN '{$_GET["fecha_inicio"]}'
	AND '{$_GET["fecha_fin"]}'
	GROUP BY
	fecha_ventas
	) AS t_num_ventas
	USING(fecha_ventas)
	LEFT JOIN 
	(
	SELECT
	fecha_ventas,
	SUM(ganancia) AS ganancia_dia
	FROM
	ventas_detalle
	LEFT JOIN ventas USING (id_ventas)
	WHERE
	estatus_ventas <> 'CANCELADO'
	AND fecha_ventas BETWEEN '{$_GET["fecha_inicio"]}'
	AND '{$_GET["fecha_fin"]}'
	GROUP BY
	fecha_ventas
	) AS ganancia_dia
	USING (fecha_ventas)
	
	
	";
	
	$resultadoVentas = mysqli_query($link,$consultaVentas);
	
	
	$importe_departamento= "
	SELECT
	id_ventas,
	id_departamentos,
	nombre_departamentos,
	SUM(importe) AS importe_departamento,
	SUM(ganancia) AS ganancia_departamento
	FROM
	ventas
	LEFT JOIN ventas_detalle USING (id_ventas)
	LEFT JOIN productos USING (id_productos)
	LEFT JOIN departamentos USING (id_departamentos)
	
	WHERE
	estatus_ventas <> 'CANCELADO'
	AND fecha_ventas BETWEEN '{$_GET["fecha_inicio"]}' AND '{$_GET["fecha_fin"]}'
	
	GROUP BY id_departamentos
	ORDER BY ganancia_departamento DESC
	
	";
	
	$result_departamento = mysqli_query($link, $importe_departamento);
	
?>
<pre hidden>
	<?php echo $consultaVentas;?>
</pre>

<?php 
	if(mysqli_num_rows($resultadoVentas) < 1){
	?>
	<br>
	<br>
	<div class="alert alert-warning text-center">
	  <strong>No hay pagos en estas fechas</strong> 
	</div>
	<?php		
	}
	else{
	?>
	
	<div class="col-sm-6">
		<div class="panel panel-primary">
			<div class="panel-heading hidden-print">
				<h4 class="text-center"> 
					Ventas por Día
				</h4>
			</div>
			<div class="panel-body" id="panel_ingresos">
				<div class="table-responsive">
					
					<table class="table table-hover">
						<tr>
							<th class="text-center"> Fecha</th>
							<th class="text-right"> Num. Ventas</th>
							<th class="text-right"> Ingresos</th>
							<th class="text-right"> Ganancia</th>
						</tr>
						<?php
							$total_ventas = 0;
							$total_ganancia = 0;
							$total_num_ventas = 0;
							
							while($row_ventas = mysqli_fetch_assoc($resultadoVentas)){
								extract($row_ventas);
								$total_ventas+= $ventas_dia;
								$total_ganancia+= $ganancia_dia;
								$total_num_ventas+= $num_ventas;
							?>
							<tr>
								<td class="text-center">
									<a href="../resumen.php?fecha_ventas=<?php echo $fecha_ventas?>">
										<?php echo date("d/m/Y", strtotime($fecha_ventas));?>
									</a>
								</td>
								<td class="text-right">
									<?= number_format($num_ventas);?>
								</td>
								<td class="text-right">
									<?php echo "$".number_format($ventas_dia,2);?>
								</td>
								<td  class="text-right">
									<?php echo "$".number_format($ganancia_dia, 2);?>
								</td>
							</tr>
							
							<?php
							}
						?>
						
						<tfoot>
							<tr class="bg-info">
								<td class="text-danger">
									<big><b>TOTAL:</b></big>
								</td>
								<td class="text-right"><?= number_format($total_num_ventas);?>
								<td class="text-right"><?=number_format($total_ventas,2);?>
								</td>
								<td  class="text-right">
									<?php 
										echo "$". number_format($total_ganancia,2);
									?>
								</td>
							</tr>
						</tfoot>
					</table> 
					
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-6 ">
		<div class="panel panel-primary">
			<div class="panel-heading hidden-print">
				<h4 class="text-center">
					Ventas por Departamento
				</h4>
			</div>
			<div class="panel-body" >
				<div class="table-responsive">
					
					<table class="table table-hover" >
						<thead>
							<tr>
								<th  onclick="sortTable(0)" class="text-left">Departamento</th>
								<th onclick="sortTable(1)"  class="text-right">Suma</th>
								<th onclick="sortTable(1)"  class="text-right">Ganancia</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
								$total_departemento = 0;
								$total_ganancia = 0;
								
								while($fila = mysqli_fetch_assoc($result_departamento)){
									$total_departemento+= $fila["importe_departamento"];
									$total_ganancia+= $fila["ganancia_departamento"];
								?>
								
								<tr class="text-center">
									
									<td class="text-left"><?= $fila["nombre_departamentos"];?></td>
									<td class="text-right"><?= number_format($fila["importe_departamento"],2);?></td>
									<td class="text-right"><?= number_format($fila["ganancia_departamento"],2);?></td>
									
								</tr>
								
								<?php
									
								}
							?>
						</tbody>
						<tfoot>
							<tr class="bg-info">
								<td class="text-left">
									<big><b>TOTAL:</b></big>
								</td>
								<td class="text-right">
									$<?= number_format($total_departemento,2);?>
								</td>
								<td  class="text-right">
									$<?= number_format($total_ganancia,2);?>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>		
	
	<?php
	}
?>			