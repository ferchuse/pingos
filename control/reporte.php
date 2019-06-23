<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_fin = $_POST['fecha_fin'];
	
	
	$consultaVentas = "SELECT
	fecha_ventas,
	COALESCE(SUM(total_ventas), 0) AS ventas_dia,
	ganancia_dia
	FROM
	ventas
	LEFT JOIN (
	
	SELECT
	fecha_ventas,
	SUM(ganancia) AS ganancia_dia
	FROM
	ventas_detalle
	RIGHT JOIN ventas USING (id_ventas)
	WHERE estatus_ventas <> 'CANCELADO'
	GROUP BY
	fecha_ventas
	) AS t_ganancia USING (fecha_ventas)
	
	WHERE estatus_ventas <> 'CANCELADO'
	GROUP BY
	fecha_ventas
	
	
	";
	$result = mysqli_query($link,$consultaVentas);
	$row_count = mysqli_num_rows($result);
	
	
	
?>
<?php 
	if($row_count < 1){
	?>
	<br>
	<br>
	<div class="alert alert-warning text-center">
	  <strong>No hay pagos en estas fechas</strong> 
	</div>
	<?php		
		}else{
	?>
	
	<div class="col-sm-6">
		<div class="panel panel-primary">
			<div class="panel-heading hidden-print">
				<h4 class="text-center"> 
					Ingresos
				</h4>
			</div>
			<div class="panel-body" id="panel_ingresos">
				<div class="table-responsive">
					<h4>
						<table class="table table-hover">
							<tr>
								<th class="text-center"> Fecha</th>
								<th class="text-center"> Ingresos</th>
								<th class="text-center"> Ganancia</th>
								<th class="text-center hidden"> Acciones</th>
							</tr>
							<?php
								
								$resultadoVentas = mysqli_query($link,$consultaVentas);
								
								while($row_ventas = mysqli_fetch_assoc($resultadoVentas)){
									extract($row_ventas);
									$total_ventas+= $ventas_dia;
									$total_ganancia+= $ganancia_dia;
								?>
								<tr>
									<td class="text-center">
										<a href="resumen.php?fecha_ventas=<?php echo $fecha_ventas?>">
												<?php echo date("d/m/Y", strtotime($fecha_ventas));?>
										</a>
									</td>
									<td class="text-center">
										<?php echo "$".number_format($ventas_dia,2);?>
									</td>
									<td class="text-center">
										<?php echo "$".number_format($ganancia_dia, 2);?>
									</td>
								</tr>
								<?php
								}
							?>
							
							<tr class="bg-info">
								<td colspan="1" class="text-right text-right text-danger">
									<big><b>TOTAL:</b></big>
								</td>
								<td class="text-center">
									<?php 
										echo "$". number_format($total_ventas,2);
									?>
								</td>
								<td class="text-center">
									<?php 
										echo "$". number_format($total_ganancia,2);
									?>
								</td>
							</tr>
						</table> 
					</h4>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="panel panel-primary">
			<div class="panel-heading hidden-print">
				<h4 class="text-center">
					Egresos
				</h4>
			</div>
			<div class="panel-body" id="panel_egresos">
				<div class="table-responsive">
					<h4>
						<table class="table table-hover">
							<tr>
								<th class="text-center">Fecha</th>
								<th class="text-center">Nombre</th>
								<th class="text-center">Area</th>
								<th class="text-center">Cantidad</th>
								<th class="text-center hidden-print">Acciones</th>
							</tr>
							<?php 
								$consultar = "SELECT * FROM egresos WHERE fecha_egresos BETWEEN '$fecha_inicio' AND '$fecha_fin' GROUP BY fecha_egresos";
								$resultados = mysqli_query($link,$consultar);
								$totales = array();
								while($row = mysqli_fetch_assoc($resultados)){
									extract($row);
									if($estatus_egresos == 'CANCELADO'){
									?>
									<tr class="text-center">
										<td><s><?php echo date("d/m/Y", strtotime($fecha_egresos));?></s></td>
										<td><s><?php echo $descripcion_egresos;?></s></td>
										<td><s><?php echo $area_egresos;?></s></td>
										<td><s><?php echo $cantidad_egresos;?></s></td>
									</tr>
									<?php
										}else{ 
										
										$totales[] = $cantidad_egresos;
									?>
									<tr class="text-center">
										<td><?php echo date("d/m/Y", strtotime($fecha_egresos));?></td>
										<td><?php echo $descripcion_egresos;?></td>
										<td><?php echo $area_egresos;?></td>
										<td><?php echo "$".$cantidad_egresos;?></td>
										<td class="text-center hidden-print">
											<button class="btn btn-danger btn-cancela" data-id_egresos="<?php echo $id_egresos;?>" title="Cancelar" type="button">
												<i class="fa fa-times"></i>
											</button>
										</td>
									</tr>
									<?php		
									}
								}
								
							?>
							<tr class="<?php echo $color;?>">
								<td colspan="3" class="text-right text-right text-danger">
									<big><b>TOTAL:</b></big>
								</td>
								<td class="text-center">
									<?php 
										$forma2 = array_sum($totales);
										echo "$". number_format(array_sum($totales),2);
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