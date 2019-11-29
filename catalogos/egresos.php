<?php
	
	include("../login/login_success.php");
	include("../conexi.php");
	$link = Conectarse();
	$menu_activo = "catalogos";
	$consulta = "SELECT * FROM catalogo_egresos";
	$result = mysqli_query($link, $consulta);
	
	if ($result) {
		while ($fila = mysqli_fetch_assoc($result)) {
			$egresos[] = $fila;
		}
		} else {
		die("Error en la consulta $consulta" . mysqli_error($link));
	}
	
?>

<!DOCTYPE html>
<html lang="es">
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Catálogo Egresos</title>
		
		<!-- Fonts & Styles -->
		<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
		<?php include("../styles_carpetas.php") ?>
		<link rel="stylesheet" href="../css/catalogos.css">
	</head>
	
	<body class="egresos">
		<!-- "Menú" -->
		<?php include("menu.php"); ?>
		
		<!-- Encabezado -->
		<section class="encabezado container">
			<!-- Título -->
			<div class="titulo">EGRESOS</div>
			
			<hr>
			
			<!-- Botón: Modal Egresos -->
			<div class="col-md-12 text-right">
				<button id="nuevo" type="button" class="btn btn-primary">
					<i class="fa fa-plus"></i><strong> Egreso</strong>
				</button>
			</div>
		</section>
		<br>
		<!-- Tabla Egresos -->
		<section class="container">
			<table class="table table-hover table-bordered">
				<tr class="encabezados success">
					<td><strong>ID</strong></td>
					<td><strong>Egreso</strong></td>
					<td><strong>Acciones</strong></td>
				</tr>
				
				<?php foreach ($egresos as $i => $fila) : ?>
				
				<tr class="contenido">
					<td><?php echo $fila["id_catalogo_egresos"] ?></td>
					<td><?php echo $fila["tipo_egreso"] ?></td>
					<td>
						<button class="btn btn-warning btn_editar" type="button" data-id_registro="<?php echo $fila["id_catalogo_egresos"] ?>">
							<i class="fas fa-edit"></i> Editar
						</button>
					</td>
				</tr>
				
				<?php endforeach ?>
				
			</table>
		</section>
		
		<?php include('../scripts_carpetas.php'); ?>
		<?php include('form_egresos.php'); ?>
		
		<pre hidden id="debug">
			<?php //print_r($departamentos) ?>
			<?php //echo var_dump($departamentos) ?>
		</pre>
		
	</body>
	
	<script>
		$("#nuevo").click(function() {
			$("#id_catalogo_egresos").val("");
			$("#tipo_egreso").val("");
			$("#modal_edicion").modal("show")
		});
		
		$("#form_edicion").submit(guardarRegistro);
		$(".btn_editar").click(cargarDatos);
		
		function cargarDatos(event) {
			console.log("event", event);
			let $boton = $(this);
			let $icono = $(this).find(".fas");
			let $id_registro = $(this).data("id_registro");
			$boton.prop("disabled", true);
			$icono.toggleClass("fa-edit fa-spinner fa-spin");
			$.ajax({
				"url": "funciones/fila_select.php",
				"dataType": "JSON",
				"data": {
					"tabla": "catalogo_egresos",
					"id_campo": "id_catalogo_egresos",
					"id_valor": $id_registro
				}
				}).done(function alTerminar(respuesta) {
				console.log("respuesta", respuesta);
				$boton.prop("disabled", false);
				$icono.toggleClass("fa-edit fa-spinner fa-spin");
				$("#modal_edicion").modal("show")
				$("#id_catalogo_egresos").val(respuesta.data.id_catalogo_egresos);
				$("#tipo_egreso").val(respuesta.data.tipo_egreso);
				
			})
		}
		
		function guardarRegistro(event) {
			event.preventDefault()
			let $boton = $(this).find(':submit');
			let $icono = $(this).find(".fas");
			$boton.prop("disabled", true);
			$icono.toggleClass("fa-save fa-spinner fa-spin");
			console.log("guardarRegistro");
			$.ajax({
				"url": "control/guardar_catalogo_egresos.php",
				"method": "POST",
				"data": {
					"tabla": "catalogo_egresos",
					"id_campo": $("#id_catalogo_egresos").val(),
					"name": $("#tipo_egreso").val()
					
				}
				}).done(function alTerminar(respuesta) {
				console.log("respuesta", respuesta);
				$boton.prop("disabled", false);
				$icono.toggleClass("fa-save fa-spinner fa-spin");
				$("#modal_edicion").modal("hide");
				window.location.reload(true);
			});
			
		}
	</script>
	
</html>