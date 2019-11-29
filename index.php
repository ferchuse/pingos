<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "principal";
	error_reporting(0);
	
?>
<!DOCTYPE html>
<html lang="es">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Nueva Venta</title>
		<?php include("styles.php"); ?>
		<style>
			.tabla_totales .row {
			margin-bottom: 10px;
			}
			
			.tab-pane .productos {
			display: block;
			overflow: auto;
			overflow-x: hidden;
			height: 300px;
			width: 100%;
			padding: 10px;
			}
			
			.sticky-footer {
			position: fixed;
			right: 0;
			bottom: 0;
			}
			
			.nav-tabs>li.active>a {
			font-color: white !importnat;
			background-color: #46b8da !important;
			}
		</style>
		<link rel="stylesheet" href="css/forma_pago.css">
		<link rel="stylesheet" href="css/b4-margin-padding.css">
		<link rel="stylesheet" href="css/b4-radios.css">
	</head>
	
	<body>
		
		<?php include("menu.php"); ?>
		
		<div class="container-fluid hidden-print">
			<div class="row">
				<form id="form_agregar_producto" class="form-inline" autocomplete="off">
					<div class="col-md-4">
						<label for="">Código:</label>
						
						<input tabindex="-1" id="codigo_producto"  type="text" class="form-control" placeholder="ESC" size="50">
						
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Descripción:</label>
							<input tabindex="-1" id="buscar_producto"  autofocus type="text" class="form-control" size="50" placeholder="F10">
						</div>
					</div>
				</form>
				<?php
				// if ($_COOKIE["permiso_usuarios"] != "mostrador") { 
					if(false){
					?>
					<div class="col-md-4">
						<div class="form-group">
							
							<button tabindex="-1" class="btn btn-info pull-right" id="btn_refresh">
								<i class="fa fa-sync"></i> F4 - Cremeria
							</button>
						</div>
						
					</div>
					<?php
					}
				?>
			</div>
			
			<hr>
			<ul id="tabs_ventas" class="nav nav-tabs" style="margin: 10px 0 10px 0;">
				<li class="active">
					<a data-toggle="tab" href="#tab1">
						<span>Mostrador</span>
						<input type="hidden" class="id_ventas" value="">
					</a>
				</li>
				<li>
					<a data-toggle="tab" href="#tab2">
						<span>Cliente 2</span>
						<input type="hidden" class="id_ventas" value="">
					</a>
				</li>
				
				<li>
					<a data-toggle="tab" href="#tab3">
						<span>Cliente 3</span>
						<input type="hidden" class="id_ventas" value="">
					</a>
				</li>
				
			</ul>
			
			<div class="tab-content">
				<div id="tab1" class="tab-pane in active">
					<div class="productos">
						<table id="tabla_venta" class="tabla_venta table table-bordered table-condensed">
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
							<tbody>
								
							</tbody>
						</table>
					</div>
					<section id="footer">
						<div class="row">
							<div class="col-sm-1 col-sm-offset-1 lead">
								<label>Artículos </label>
								<input class="form-control articulos" type="number" autocomplete="off" readonly value="0">
							</div>
							<div class="col-sm-7 text-right">
							</div>
							<div class="col-sm-1 h2">
								<strong>TOTAL:</strong>
							</div>
							<div class="col-sm-2 h1">
								<input readonly type="text" class="form-control input-lg text-right total" value="0" name="total">
							</div>
						</div>
					</section>
				</div>
				
				<div id="tab2" class="tab-pane">
					<div class="productos">
						<table class="tabla_venta table table-bordered table-condensed">
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
							<tbody>
								
							</tbody>
						</table>
					</div>
					<section id="footer">
						<div class="row">
							<div class="col-sm-1 col-sm-offset-1 lead">
								<label>Artículos </label>
								<input class="form-control articulos" type="number" autocomplete="off" readonly value="0">
							</div>
							<div class="col-sm-7 text-right">
								
							</div>
							<div class="col-sm-1 h2">
								<strong>TOTAL:</strong>
							</div>
							<div class="col-sm-2 h1">
								<input readonly type="text" class="total form-control input-lg text-right " value="0" name="total">
							</div>
						</div>
					</section>
				</div>
				<div id="tab3" class="tab-pane">
					<div class="productos">
						<table class="tabla_venta table table-bordered table-condensed">
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
							<tbody>
								
							</tbody>
						</table>
					</div>
					<section id="footer">
						<div class="row">
							<div class="col-sm-1 col-sm-offset-1 lead">
								<label>Artículos </label>
								<input class="form-control articulos" type="number" autocomplete="off" readonly value="0">
							</div>
							<div class="col-sm-7 text-right">
								
							</div>
							<div class="col-sm-1 h2">
								<strong>TOTAL:</strong>
							</div>
							<div class="col-sm-2 h1">
								<input readonly type="text" class="total form-control input-lg text-right " value="0" name="total">
							</div>
						</div>
					</section>
				</div>
			</div>
			
			<div class="sticky-footer">
				
				
				<?php if ($_COOKIE["permiso_usuarios"] != "mostrador") { ?>
					<button class="btn btn-success btn-lg" FORM="" id="cerrar_venta">
						F12 - Cobrar
					</button>
					<?php
						
					}
				?>
			</div>
		</div>
		
		<div id="ticket" class="visible-print">
			
		</div>
		
		<?php include('ventas/forma_pago.php'); ?>
		<?php include('forms/modal_granel.php'); ?>
		<?php include('scripts.php'); ?>
		
		<script>
			$.getScript('https://luke-chang.github.io/js-spatial-navigation/spatial_navigation.js', function() {
				$('.cliente')
				.SpatialNavigation()
				.focus(function() {
					$(this).addClass("bg-info");
				})
				.blur(function() {
					$(this).removeClass('bg-info');
				})
				.first()
				.focus();
			});
		</script>
		
		<script src="ventas/ventas.js?v=<?= date("d-m-Y-H-i-s")?>"></script>
		<!--Start of Tawk.to Script-->
		<script type="text/javascript">
			var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
			(function(){
				var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
				s1.async=true;
				s1.src='https://embed.tawk.to/5d02e5b053d10a56bd79ff1f/default';
				s1.charset='UTF-8';
				s1.setAttribute('crossorigin','*');
				s0.parentNode.insertBefore(s1,s0);
			})();
		</script>
		<!--End of Tawk.to Script-->
	</body>
	
</html>