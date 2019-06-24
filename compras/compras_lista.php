<?php
	include("../login/login_success.php");
	include("../conexi.php");
	$link = Conectarse();
	$menu_activo = "compras";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista Compras</title>
		
		<?php include("../styles_carpetas.php");?>
		
	</head>
  <body>
		<div class="container-fluid">
			<?php include("../menu_carpetas.php");?>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php include('tabla_compras.php');?>
				</div>
			</div>
		</div>
		
		<?php  include('../scripts_carpetas.php'); ?>
	</body>
</html>