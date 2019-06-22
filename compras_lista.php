<?php
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "compras";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/imprimir_pago.css" rel="stylesheet" media="all">
    <title>Lista Compras</title>
		
		<?php include("styles.php");?>
		
	</head>
  <body>
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php include('control/lista_compras.php');?>
				</div>
			</div>
		</div>
		<div id="Pago" class="visible-print">
		</div>
		
		<div class="container">
			<?php include('forms/modal_egresos.php');?>
		</div>
		<div class="container">
			<?php include('forms/tipo_pago.php');?>
		</div>
		<?php  include('scripts.php'); ?>
		<script src="js/resumen.js"></script>
		<script src="js/pagos.js"></script>
		<script src="js/numerosLetras.js"></script>
		<script src="js/modal_egresos.js"></script> 
	</body>
</html>