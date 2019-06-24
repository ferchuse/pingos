<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "resumen";
	$egresos = 0;


	if(isset($_GET["fecha_ventas"])){
		$fecha_ventas = $_GET["fecha_ventas"];
	}
	else{
		$fecha_ventas = date("Y-m-d");
	}
	
	$consulta_turno = "SELECT * FROM turnos WHERE cerrado='0'";
	$result_turno = mysqli_query($link,$consulta_turno);
	while($row_turno = mysqli_fetch_assoc($result_turno)){
		extract($row_turno);
	}
	$consultaVentas = "SELECT * FROM ventas LEFT JOIN usuarios USING(id_usuarios) 
	WHERE fecha_ventas = '$fecha_ventas' ORDER BY id_ventas DESC
	";
	$resultadoVentas = mysqli_query($link,$consultaVentas);
	
	
	$consultar = "SELECT * FROM egresos
	WHERE fecha_egresos = '$fecha_ventas'
	";
	$resultados = mysqli_query($link,$consultar);
	
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/imprimir_pago.css" rel="stylesheet" media="all">
    <title>Resumen</title>
		
		<?php include("styles.php");?>
		
	</head>
  <body>
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		<div class="container-fluid hidden-print">
			<div class="row">
				
				<h4 class="text-center">
					Resumen del día <?php echo date("d/m/Y", strtotime($fecha_ventas));?>
				</h4>
				<div class="col-md-6"> 
					<?php 	if ($_COOKIE["permiso_usuarios"] == "administrador") {?>
						<form class="form-inline" id="form_resumen">
							<div class="form-group">
								<label>Fecha: </label>
								<input type="date" class="form-control" value="<?php echo $fecha_ventas;?>" name="fecha_ventas" id="fecha_ventas">
							</div>
						</form>
						<?php
						}
					?>
				</div>
				<div class="col-md-6 text-right hidden-print">
					<button class="btn btn-warning"  id="btn_egreso">
						<i class="fa fa-arrow-left"></i> Egreso
					</button>
					
					<button class="btn btn-info" type="button" title="Imprimir Corte" id="btn_resumen">
						<i class="fa fa-print"></i>
						Imprimir Corte
					</button>
					<button class="btn btn-success " type="button" title="Corte de Caja" id="btn_corte">
						<i class="fa fa-history"> </i> 
						Cerrar Turno
					</button>
					
					<button hidden class="btn btn-primary hidden-print hidden" type="button" title="Corte Caja " id="btn_corte_caja">
						<i class="fas fa-cut"></i> Corte de Caja
					</button>
				</div>
			</div>
			<hr>
			<form class="" id="lista_egresos">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-7">
							<div class="panel panel-primary hidden-print"  id="head_ingresos">
								<div class="panel-heading text-center">
									Ingresos
								</div>
								<div style="height: 350px; overflow: auto;" class="panel-body" id="panel_ingresos">
									<div class="table-responsive">
										<h4>
											<table class="table table-hover">
												<tr>
													<th class="text-center"> Folio</th>
													<th class="text-center"> Hora</th>
													<th class="text-center"> Efectivo</th>
													<th  class="text-center"> Tarjeta</th>
													<th hidden class="text-center"> Vales</th>
													<th  class="text-center"> Total</th>
													<th class="text-center"> Estatus</th>
													<th class="text-center hidden-print"> Acciones</th>
												</tr>
												
												
												<?php
													
													
													$total = 0;
													$tarjeta= 0;
													$efectivo= 0;
													$vale= array();
													while($row_ventas = mysqli_fetch_assoc($resultadoVentas)){
														extract($row_ventas);
														$vale[] = $vale_ventas;
														
														// if (isset($_GET)){
														// $id_ventas={$_GET[id_ventas];
														// }
														// else{
														// $id_ventas=$id_ventas;
														// }
														
														if($estatus_ventas == "CANCELADO"){
															$color = "danger";
														}
														else{
															$color = "success";
															$efectivo+= $efectivo_ventas;
															$tarjeta+= $pago_tarjeta;													
															$num_ventas++;
														}
														if($estatus_ventas == "PENDIENTE"){
															$color = "warning";
															}else if($estatus_ventas == "PRESTAMO"){
															$color = "default";
														}
													?>
													<tr class="<?php echo $color;?>">
														<td id="id_ventas" class="text-center"><?php echo $id_ventas;?></td>
														<td class="text-center"><?php echo $hora_ventas;?></td>
														<td class="text-center">
															<?php 
																echo '$'.$efectivo_ventas;
															?>
														</td>
														<td class="text-center">
															<?php
																$pago_tarjeta *= 1.05;
																echo '$'.$pago_tarjeta;
															?>
														</td>
														<td class="text-center"><?php echo "$".$total_ventas ?></td>
														<td class="text-center"><?php echo $estatus_ventas;?></td>
														<td class="text-center h.idden-print">
															<?php
																if($estatus_ventas == "PENDIENTE" || $estatus_ventas == "PRESTAMO"){
																?>
																<button class="btn btn-success btn_pagar" title="Pagar" type="button" data-id_ventas="<?php echo $id_ventas;?>"><i class="fa fa-usd" ></i></button>
																<?php 
																}
															?>
															<?php 
																if($estatus_ventas != "PENDIENTE" ) {
																?>
																<button class="btn btn-info btn_ticketPago" title="Reimprimir Ticket"  type="button"  data-id_ventas="<?php echo $id_ventas;?>">
																	<i class="fa fa-print"></i>
																</button>
																
																<!-- Modal Imprimir Venta -->
																<button type="button" class="btn btn-success btn_ver" data-id_ventas="<?php echo $id_ventas;?>">
																	<i class="fas fa-eye"></i>
																</button>
																
																<?php 
																}
															?>
															<?php 
																if($_COOKIE["permiso_usuarios"] == "administrador"  && $estatus_ventas != "CANCELADO") {
																?>
																<button class="btn btn-danger btn_cancelar " title="Cancelar Venta"  type="button"  data-id_ventas="<?php echo $id_ventas;?>">
																	<i class="fa fa-times"></i>
																</button>
																<button  class="btn btn-warning btn_devolucion hidden" title="Devolver Venta"  type="button"  data-id_ventas="<?php echo $id_ventas;?>">
																	<i class="fas fa-undo"></i>
																</button>
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
								<div class="panel-footer">
									<h4 class=""> 
										<table class="container">
											<tr class="h3">
												<td colspan="" class="col-sm-4 text-center">
													<b>TOTAL:</b>
												</td>
												<td colspan="" class="col-sm-3 text-center">
													<?php 
														$ingresos = $efectivo +  $tarjeta;
														echo "$".number_format($ingresos, 2);
													?>
												</td>
												<td colspan="" class="col-sm-5 text-center">
												</td>
											</tr>
										</table>
									</h4>
								</div>
							</div>
						</div>
						
						<div class="col-md-5">
							<div class="panel panel-primary hidden-print" id="head_egresos">
								<div class="panel-heading text-center">
									Egresos
								</div>
								<div style="hight: 350px; overflow: auto;" class="panel-body" id="panel_egresos">
									<div class="table-responsive">
										<h4>
											<table class="table table-hover">
												<tr>
													<th class="text-center">Hora</th>
													<th class="text-center">Nombre</th>
													<th class="text-center">Area</th>
													<th class="text-center">Cantidad</th>
													<th class="text-center hidden-print">Acciones</th>
												</tr>
												<?php 
													
													while($row = mysqli_fetch_assoc($resultados)){
														extract($row);
														if($estatus_egresos == 'CANCELADO'){
														?>
														<tr class="text-center">
															<td><s><?php echo $hora_egresos;?></s></td>
															<td><s><?php echo $descripcion_egresos;?></s></td>
															<td><s><?php echo $area_egresos;?></s></td>
															<td><s><?php echo $cantidad_egresos;?></s></td>
														</tr>
														<?php
															}else{ 
															
															$egresos+= $cantidad_egresos;
														?>
														<tr class="text-center">
															<td><?php echo $hora_egresos;?></td>
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
												<tr class="hidden-print">
													<td colspan="3" class="text-right text-right text-danger">
														<b>TOTAL:</b>
													</td>
													<td class="text-center hidden-print">
														<?php 
															echo "<strong>" . "$". number_format($egresos, 2) . "</strong>";
														?>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						
					</div>
					
					<div class="row">
						<div class="col-md-12 text-center hidden-print">
							<tr>
								<td class="text-danger">
									<h3>
										<b>BALANCE TOTAL:</b>
									</h3>
								</td>
								<td class="text-center">
									<h3>
										<?php 
											$balance = $ingresos -$egresos;
											echo "$". number_format($balance,2);
										?>
										<input class="hidden" id="saldo_final" value="<?php echo $balance?>">
									</h3>
								</td>
							</tr>
						</div>
					</div>
				</form>
			</div>
			
			
			<!-- Ticket Resumen -->
			<div id="resumen" class="visible-print">
				
				<div style="margin-top: 25px;" class="container-fluid">
					
					<div class="row">
						<div class="col-xs-7"><strong>Resumen del Día:</strong></div>
						<div class="col-xs-4 text-right"><?php echo date("d/m/Y")?></div>
					</div>
					<div class="row">
						<div class="col-xs-7"><strong>Hora:</strong></div>
						<div class="col-xs-4 text-right"><?php echo date("H:i:s")?></div>
					</div>
					<div class="row">
						<div class="col-xs-7"><strong>Usuario:</strong></div>
						<div class="col-xs-4 text-right"><?php echo $_COOKIE["nombre_usuarios"];?></div>
					</div>
					<div class="row">
						<div class="col-xs-7"><strong>Número de Ventas:</strong></div>
						<div class="col-xs-4 text-right"><?php echo $num_ventas;?></div>
					</div>
					<div class="row">
						<div class="col-xs-7"><strong>Importe de Ventas:</strong></div>
						<div class="col-xs-4 text-right"><?php echo "$". number_format($ingresos, 2);?></div>
					</div>
					<div class="row">
						<div class="col-xs-7"><strong>Egresos:</strong></div>
						<div class="col-xs-4 text-right"><?php echo "$". number_format($egresos, 2);?></div>
					</div>
					<div class="row">
						<div class="col-xs-7"><strong>Total:</strong></div>
						<div class="col-xs-4 text-right"><?php echo "$". number_format($balance, 2);?></div>
					</div>
					
				</div>
				
			</div>
			
			<div id="Pago" class="visible-print">
			</div>
			
			
			<div id="ver_venta" >
			</div>
			
			
			
			
			<?php include('forms/modal_egresos.php');?>
			
			
			<?php  include('scripts.php'); ?>
			<script src="js/resumen.js"></script>
			<script src="js/pagos.js"></script>
			<script src="js/numerosLetras.js"></script>
			<script src="js/modal_egresos.js"></script> 
			

		</body>
	</html>												