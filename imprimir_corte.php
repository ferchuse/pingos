<?php 
	include ("conexi.php");
	 $link = Conectarse();
	$id_usuarios = $_POST['id_usuarios'];
	$id_turnos = $_POST['id_turnos'];
	$todo = $_POST['todo'];
	// $id_usuarios = $_SESSION['id_usuarios'];
	
	
	
	$consultaVentas = "SELECT * FROM ventas 
							LEFT JOIN usuarios USING(id_usuarios)
							WHERE fecha_ventas = CURDATE()
							";
	$resultaVentas = mysqli_query($link,$consultaVentas);
	while($row_V = mysqli_fetch_assoc($resultaVentas)){
		extract($row_V);

	}
?>
		<div class="container-fluid text-center hoja visible-print" id="imprimir_corte">   
			<br>
		
			<div class="row cuerpo">
				
				<div class="folio">
					No.Turno <?php echo $id_turnos;?><br><br>
				</div>
				<div class="fecha">
					<strong>Usuario: </strong><?php echo $nombre_usuarios; ?>
				</div>
				<div class="col-xs-12">
					<h4 class="text-center">Fecha<br><?php echo date("d/m/Y");?></h4>
				</div>
				<hr>
				<br>
				<div class="col-xs-12 contenido">
					<br>
					<div class="text-left">
						<strong>INGRESOS</strong>
						<div class="row">
							<table class="table table-responsive">
								<thead></thead>
									<tr>
										<th class="text-center">Folio</th>
										<th class="text-center">Cantidad</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$consultaVentas = "SELECT * FROM ventas LEFT JOIN usuarios USING(id_usuarios) 
																	WHERE fecha_ventas = CURDATE() 
																	";
									$resultadoVentas = mysqli_query($link,$consultaVentas);
										while($fila_ticket = mysqli_fetch_assoc($resultadoVentas)){
											extract($fila_ticket);
									?>
									<tr>
										<td class="text-center"><?php echo $id_ventas;?></td>
										<td class="text-center"><?php echo "$".$total_ventas;?></td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</div>
						
					</div>
				</div>
				<!-- ---------------------------------------------------------------------  -->
				<div class="col-xs-12 contenido">
					<br>
					<div class="text-left">
						<strong>EGRESOS</strong>
						<div class="row">
							<table class="table table-responsive">
								<thead></thead>
									<tr>
										<th class="text-center">Descripción</th>
										<th class="text-center">Cantidad</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$consultarEgresos = "SELECT * FROM egresos
															WHERE fecha_egresos = CURDATE()
																	";
										$resultegresos = mysqli_query($link,$consultarEgresos);
										while($rowEgresos = mysqli_fetch_assoc($resultegresos)){
											extract($rowEgresos);
									?>
									<tr>
										<td class="text-center"><?php echo $descripcion_egresos;?></td>
										<td class="text-center"><?php echo "$".$cantidad_egresos;?></td>
									</tr>
									<?php
										}
									?>
									<tr>
										<td colspan="1" class="text-right">
											<br>
											<b>TOTAL:</b>
										</td>
										<td class="text-center">
										<br>
											<?php 
												echo "$". number_format($todo,2);
											?>
											<input type="text" id="total" class="hidden" value="<?php echo $todo;?>">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<i><u>(<span id="total_texto"></span>/100 M.N).</u></i>
					</div>
				</div>
			</div>
			<div class="text-center footer">
				<br>
			</div>
		</div>
	