<div class="container hidden-print">
		<div class="row">
			<div class="col-md-12 text-right hidden-print">
				<h2 class="text-center">Lista de Compras</h2>
				<hr>
				
			</div>
			<div class="col-md-12 text-right ">
				<a href="compras_nueva.php" class="btn btn-success"><i class="fas fa-plus"></i> Nueva</a>
			</div>
		</div>
		<br>
		<form id="lista_egresos">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary hidden-print"  id="head_ingresos">
						<div class="panel-heading">
							<h4 class="text-center"> 
								Compras
							</h4>
						</div>
						<div class="panel-body" id="panel_ingresos">
							<div class="table-responsive">
								<h4>
									<table class="table table-hover">
										<tr>
											<th class="text-center"> Folio</th>
											<th class="text-center"> Fecha</th>
											<th class="text-center"> Proveedor</th>
											<th  class="text-center"> Importe Total</th>
											<th  class="text-center"> Acciones</th>
										</tr>
										
									
										<?php
											
											
											$consultaVentas = "SELECT * FROM compras LEFT JOIN proveedores USING(id_proveedores)";
											$resultadoVentas = mysqli_query($link,$consultaVentas);
											$total = array();
											$tarjeta= array();
											$efectivo= array();
											$vale= array();
											while($row_ventas = mysqli_fetch_assoc($resultadoVentas)){
												extract($row_ventas);
												
													$total[] = $total_compras;
													
													if($estatus_compras == "CANCELADA"){
														$color = "danger";
													}else{
														$color = "success";
													}
													if($estatus_compras == "PENDIENTE"){
														$color = "warning";
													}else if($estatus_compras == "PRESTAMO"){
														$color = "default";
													}
										?>
											<tr class="<?php echo $color;?>">
												<td class="text-center"><?php echo $id_compras;?></td>
												<td class="text-center"><?php echo date("d/m/Y", strtotime($fecha_compras));?></td>
												<td class="text-center">
													<?php 
														echo $nombre_proveedores;
													?>
												</td>
												<td class="text-center">
													<?php
														echo '$'.$total_compras;
													?>
												</td>
												<td class="text-center">
													<a target="_blank" href="imprimir_compras.php?id_compras=<?php echo $id_compras?>" id="imprimir_compra" class="btn btn-primary"><i class="fas fa-print"></i></a>
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
			</div>
		</form>
	</div>