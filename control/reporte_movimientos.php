<?php 
	include('../conexi.php');
	$link = Conectarse();
	
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_fin = $_POST['fecha_fin'];
	
	
	$consultaVentas = "SELECT fecha_ventas,importe, sum(ganancia) AS gananciaDia FROM ventas
	LEFT JOIN ventas_detalle USING(id_ventas)
	GROUP BY fecha_ventas 
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
	
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading hidden-print">
				<h4 class="text-center">
					Movimientos
				</h4>
			</div>
			<div class="panel-body" id="panel_egresos">
				<div class="table-responsive">
					<h4>
						<table class="table table-hover">
							<tr>
								<th class="text-center">Fecha</th>
								<th class="text-center">Hora</th>
								<th class="text-center">Descripción del Producto</th>
								<th class="text-center">Movimiento</th>
								<th class="text-center">Había</th>
								<th class="text-center">Cantidad</th>
								<th class="text-center">Hay</th>
								<th class="text-center">Referencia</th>
								<th class="text-center">Usuario</th>
							</tr>
							<?php 
								$consulta_movimientos = "SELECT * FROM almacen_movimientos
								LEFT JOIN productos USING(id_productos)
								LEFT JOIN usuarios USING(id_usuarios) 
								
								WHERE date(fecha_movimiento) BETWEEN '$fecha_inicio' AND '$fecha_fin'
								
								ORDER BY fecha_movimiento DESC
								";
								$resultados = mysqli_query($link,$consulta_movimientos) or die ("<pre>Error en $consulta_movimientos". mysqli_error($link). "</pre>");
								$totales = array();
								
								while($row = mysqli_fetch_assoc($resultados)){
									extract($row);
								
									?>
									<tr class="text-center">
										<td><?php echo date("d/m/Y", strtotime($fecha_movimiento));?></td>
										<td><?php echo date("H:i:s", strtotime($fecha_movimiento));?></td>
										<td><?php echo $descripcion_productos;?></td>
										<td><?php echo $tipo_movimiento;?></td>
										<td><?php echo $exist_anterior;?></td>
										<td><?php echo $cantidad;?></td>
										<td><?php echo $exist_nueva;?></td>
										<td><?php echo $referencia;?></td>
										<td><?php echo $nombre_usuarios;?></td>
									</tr>
									<?php
										
								}
								
							?>
							
							<?php 
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>	