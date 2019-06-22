<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "reportes";
	
	$dt_fecha_inicial = new DateTime("first day of this month");
	$dt_fecha_final = new DateTime("last day of this month");
	
	$fa_inicial = $dt_fecha_inicial->format("Y-m-d");
	$fa_final = $dt_fecha_final->format("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		
    <title>Reportes</title>
		
		<?php include("styles.php");?>
		
	</head>
  <body>
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">Reporte de Movimientos</h3>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form id="form_reportes" class="form-inline">
						<div class="form-group">
							<label for="fecha_inicio">Desde:</label>
							<input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="<?php echo $fa_inicial;?>">
						</div>
						<div class="form-group">
							<label for="fecha_fin">Hasta:</label>
							<input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="<?php echo $fa_final;?>">
						</div>
						<button type="submit" class="btn btn-success" id="btn_buscar">
							<i class="fa fa-search"></i> Buscar
						</button>
						<div>
							<button class="btn btn-info hidden" type="button" id="btn_imprimirR"> <i class="fa fa-print"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
			
			<div class="row text-center table-responsive" id="contenedor_tabla">
				
			</div>
			<hr>
			<div id="ReporteTicket" class="visible-print">
				</div>
			
		</div >
		
		
		<?php  include('scripts.php'); ?>
		<script src="js/reportes_movimientos.js"></script>
	</body>
</html>