<?php
	
	$dt_fecha_inicial = new DateTime("first day of this month");
	$dt_fecha_final = new DateTime("last day of this month");
	
	
	if (isset($_GET["fecha_inicial"])) {
		$fa_inicial = $_GET["fecha_inicial"];
		}else{
		
		$fa_inicial = $dt_fecha_inicial->format("Y-m-d");
	}
	
	if (isset($_GET["fecha_final"])) {
		$fa_final = $_GET["fecha_final"];
		}else{
		
		$fa_final = $dt_fecha_final->format("Y-m-d");
	}
	
	
?>

<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-12 text-right hidden-print">
			<h2 class="text-center">Lista de Compras</h2>
			<hr>
			
		</div>
		
		<div class="col-md-12 ">
			
			<div class="row ">
				<!-- Filtro Fecha -->
				<div class="col-sm-9 text-left">
					<form id="form_reportes" class="form-inline" action="" method="">
						<div class="form-group">
							<label for="fecha_inicio">Desde:</label>
							<input type="date" name="fecha_inicial" id="fecha_inicio" class="form-control" value="<?php echo $fa_inicial; ?>">
						</div>
						<div class="form-group">
							<label for="fecha_fin">Hasta:</label>
							<input type="date" name="fecha_final" id="fecha_fin" class="form-control" value="<?php echo $fa_final; ?>">
						</div>
						<button type="submit" class="btn btn-primary" id="btn_buscar">
							<i class="fa fa-search"></i> Buscar
						</button>
					</form>
				</div>
				<!-- Boton Nueva Compra -->
				<div class="col-md-3 text-right">
					<a href="compras_nueva.php" class="btn btn-success"><i class="fas fa-plus"></i> Nueva</a>
				</div>
			</div>
			
		</div>
		
	</div>
	<br>
	<form id="lista_egresos">
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel-body" id="panel_ingresos">
					<div class="table-responsive">
						<h4>
							<table class="table table-hover">
								<tr>
									<th class="text-center"> Folio</th>
									<th class="text-center"> Fecha</th>
									<th class="text-center"> Proveedor</th>
									<th class="text-center"> Importe Total</th>
									<th class="text-center"> Acciones</th>
								</tr>
								
								
								<?php
									
									
									$consultaVentas = "SELECT * FROM compras LEFT JOIN proveedores USING(id_proveedores) WHERE date(fecha_compras) BETWEEN '$fa_inicial' AND '$fa_final' ORDER BY (fecha_compras) DESC";
									$resultadoVentas = mysqli_query($link, $consultaVentas);
									
									while ($row_ventas = mysqli_fetch_assoc($resultadoVentas)) {
										extract($row_ventas);
										
										switch($estatus_compras){
											case "CANCELADA":
											$color = "danger";
											break;	
											case "PENDIENTE":
											$color = "warning";
											break;
											default:
											$color = "success";
											break;
										}
										
									?>
									<tr class="<?php echo $color; ?>">
										<td class="text-center"><?php echo $id_compras; ?></td>
										<td class="text-center"><?php echo date("d/m/Y", strtotime($fecha_compras)); ?></td>
										<td class="text-center">
											<?php
												echo $nombre_proveedores;
											?>
										</td>
										<td class="text-center">
											<?php
												echo '$' . $total_compras;
											?>
										</td>
										
										<!-- Columna Acciones -->
										<td class="text-center">
											<a target="_blank" href="imprimir_compras.php?id_compras=<?php echo $id_compras ?>" class="btn btn-primary">
												<i class="fas fa-print"></i>
											</a>
											<?php if($estatus_compras == 'PENDIENTE'){?>
												<a target="_blank" href="compras_nueva.php?id_compras=<?php echo $id_compras ?>"  class="btn btn-warning">
													<i class="fas fa-edit"></i>
												</a>
												<?php
												}
											?>
										</td>
									</tr>
									<?php
									}
								?>
								
							</table>
						</h4>
					</div>
				</div>
				
			</div>
		</div>
	</form>
</div>

<!-- Comment David -->