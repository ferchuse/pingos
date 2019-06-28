<?php
	include("../login/login_success.php");
	include("../funciones/generar_select.php");
	include("../conexi.php");
	$link = Conectarse();
	$menu_activo = "compras";
	error_reporting(0);
	
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
				
				
				@media only screen and (max-width: 1400px) {
				.tab-pane {
				display: block;
				overflow: auto;
				overflow-x: hidden;
				height: 380px;
				width: 100%;
				padding: 10px;				
				}	
				}
				
				@media only screen and (min-width: 1400px) {
				.tab-pane {
				display: block;
				overflow: auto;
				overflow-x: hidden;
				height: 600px;
				width: 100%;
				padding: 10px;				
				}	
				
				}
			</style>  
		</style>
		
    <title>Nueva Compra</title>
    <?php include("../styles_carpetas.php");?>
	</head>
  <body>
		<div class="container-fluid hidden-print">
			<?php include("../menu_carpetas.php");?>
		</div>
		
		<div class="container-fluid hidden-print">
			<form id="form_agregar_producto" class="form-inline" autocomplete="off">
				<div class="row">
					<!-- <div class="col-md-4">
						<label for="">Código del Producto:</label>
						<input id="codigo_producto"   type="text" class="form-control" placeholder="Código de barras" size="50">
					</div> -->
					<div class="col-md-4">
						<div class="form-group">
							<label class="" for="id_compra">ID Compra:</label>
							<input readonly id="id_compra" type="text" class="form-control" value="<?php echo $_GET[id_compras];?>" placeholder="" size="50">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="buscar_producto">Producto:</label>
							<input id="buscar_producto" autofocus  type="text" class="form-control" size="50">
						</div>
					</div>
					<div class="col-sm-2 col-sm-offset-1">
						<div class="form-group">
							<label for>Proveedor</label> 
							<?php echo generar_select($link, "proveedores", "id_proveedores", "nombre_proveedores");?>
						</div>
					</div>
					
				</div>
			</form>
			
			<div class="row">
				<div class="col-md-12">
					<div class="tab-pane">
						<table id="tabla_venta" class="table table-hover table-bordered table-condensed">
							<thead class="bg-success">
								<tr>
									<th class="text-center">Cantidad</th>
									<th class="text-center">Unidad</th>
									<th class="text-center">Descripcion del Producto</th>
									<th class="text-center">Precio Unitario</th>
									<th class="text-center">Importe</th>
									<th class="text-center">Existencia</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody >
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<br>
			<section id="footer">
				<div class="row">
					
					
					<div class="col-sm-1 col-sm-offset-6 lead">
						<strong>TOTAL:</strong>
					</div>
					<div class="col-sm-2 h1">
						<input readonly id="total" type="number" class="form-control input-lg text-right " value="0" name="total">
					</div>
					
					<div class="col-sm-2 text-right">
						<button class="btn btn-success btn-lg" FORM="" id="cerrar_venta">Guardar</button>
					</div>
				</div>
			</section>
		</div>
		<div id="ticket" class="visible-print">
			
		</div>
		<?php include('../scripts_carpetas.php'); ?>
		<?php include('../forms/modal_venta.php'); ?>
		<?php include('../forms/modal_granel.php'); ?>
		<script src="compras.js"></script>
		
	</body>
</html>					