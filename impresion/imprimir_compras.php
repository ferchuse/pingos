<?php
	include("../login/login_success.php");
	include("../conexi.php");
	$link = Conectarse();
	$menu_activo = "compras";
	error_reporting(0);
	
	$consulta = "SELECT * FROM productos";
	$result = mysqli_query($link,$consulta);
	$num_rows = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<style>
			<style>
				.tabla_totales .row{
				margin-bottom: 10px;
				}
				
				.tab-pane {
				display: block;
				overflow: auto;
				overflow-x: hidden;
				height: 380px;
				width: 100%;
				padding: 10px;				
				}			
			</style>  
		</style>
		
		<title>Nueva Compra</title>
		<?php include("../styles.php");?>
	</head>
	<body>
		
		<div class="container ">

			<div class="row">
				
				<ul class="nav nav-pills nav-justified">
					<li >
						<a  href="#venta"><i class="fa fa-file-text"></i> Compra</a>
					</li>
				</ul>
				<div class="tab-content">
					
					
					
					
					
					<div id="venta" class="">
						
						<table id="tabla_venta" class="table table-hover table-bordered table-condensed">
							<thead class="bg-success">
								<tr>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Unidad</th>
									<th class="text-center">Descripcion del Producto</th>
									<th class="text-center">Precio Unitario</th>
									<th class="text-center">Importe</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody >	
							</tbody>
						</table>
						
					</div>
					
				</div>
			</div>
		</div>
		
		<br>
		
		<section id="footer">
			<div class="row">
				<div class="col-md-1 col-md-offset-9">
					<strong>TOTAL:</strong>
				</div>
				<div class="col-md-2">
					<div class="input-group input-group-lg"> 
						<span class="input-group-addon"><i class="fa fa-usd"></i></span>
						<input readonly id="total" type="text" class="form-control text-right" value="0" name="total" size="50">
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-success btn-lg" FORM="" id="cerrar_venta">Imprimir</button>
				</div>
			</div>
		</section>
		
	</div>
	
	<div id="ticket" class="visible-print">
		
	</div>
	<?php include('../scripts.php'); ?>
	<?php include('../forms/modal_venta.php'); ?>
	<?php include('../forms/modal_granel.php'); ?>
	<script src="../js/nueva_venta.js"></script>
	
</body>
</html>					