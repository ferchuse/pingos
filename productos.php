<?php
include("login/login_success.php");
include("conexi.php");
include("funciones/generar_select.php");
$link = Conectarse();
$menu_activo = "producto";
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		#respuesta_rep {
			color: red;
		}
		h-auto {
			height: auto;
		}
	</style>
	<title>Productos</title>
	<?php include("styles.php"); ?>
	<link href="css/margenes.css" rel="stylesheet" >

</head>

<body>

	<?php include("menu.php"); ?>


	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center">Productos</h2>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form id="form_filtros" class="form-inline">
					<div class="form-group">
						<label for="fecha_inicio">Departamento:</label>
						<?php echo generar_select($link, "departamentos", "id_departamentos", "nombre_departamentos", true) ?>
					</div>
					<div class="form-group">
						<label for="fecha_fin">Existencias:</label>
						<select class="form-control" name="existencia">
							<option value="">TODAS</option>
							<option value="minimo">DEBAJO DEL MINIMO</option>
						</select>
					</div>

					<button type="submit" class="btn btn-primary" id="btn_buscar">
						<i class="fa fa-search"></i> Buscar
					</button>
				</form>
				<button type="button" class="btn btn-success pull-right visible-sm visible-md visible-lg visible-xl" id="btn_alta">
					<i class="fa fa-plus"></i> Nuevo
				</button>
				<button type="submit" form="form_imprimir_precios" class="btn btn-info pull-right visible-sm visible-md visible-lg visible-xl" form="btn_imprimir_precios">
					<i class="fa fa-print"></i> Imprimir Precios
					(<span id="cant_seleccionados">0</span>)
				</button>

			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12 text-center table-responsive table-bordered visible-sm visible-md visible-lg visible-xl" id="lista_productos">
				<div class="row bg-primary">
					<div class="col-md-3 text-center font-weight-bolder">Descripción</div>
					<div class="col-md-1 text-center font-weight-bolder">Departamento</div>
					<div class="col-md-1 text-center font-weight-bolder">Costo de Compra</div>
					<div class="col-md-1 text-center font-weight-bolder">Ganancia</div>
					<div class="col-md-1 text-center font-weight-bolder">Precio Venta</div>
					<div class="col-md-1 text-center font-weight-bolder">Precio Mayoreo</div>
					<div class="col-md-1 text-center font-weight-bolder">Mínimo</div>
					<div class="col-md-1 text-center font-weight-bolder">Existencia</div>
					<div class="col-md-2 text-center font-weight-bolder">Acciones</div>
				</div>

				<div class="row">
					<div class="col-md-3 text-center mt-3 mb-3">
						<input type="text" class="form-control buscar_descripcion" data-indice="0" placeholder="Buscar Descripción">
					</div>
				</div>
			</div>

			<div class="col-md-12" id="bodyProductos">
				<div class="row">
					<div class="col text-center" colspan="9">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<form id="form_imprimir_precios" action="impresion/imprimir_precios.php">
	</form>
	<?php include('forms/productos.php'); ?>
	<?php include('forms/existencias.php'); ?>

	<?php include('scripts.php'); ?>
	<script src="js/productos.js"></script>
	<script src="js/carrito.js"></script>
	<script src="https://unpkg.com/sticky-table-headers"></script>
</body>

</html>