<?php
	
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "catalogos";
	$consulta = "SELECT * FROM proveedores";
	$result = mysqli_query($link, $consulta);
	
	if($result){
		while($fila = mysqli_fetch_assoc($result)){
			$proveedores[] = $fila;
		}
	}
	else{ 
		die("Error en la consulta $consulta". mysqli_error($link));
	}
	// echo "<script> console.log()"
		
?>

<!DOCTYPE html>
<html lang="es">
	
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
			#btn_buscar {
			position: relative;
			top: 25px;
			}
		</style>
    <title>Proveedores</title>
		
    <?php include("../styles_carpetas.php"); ?>
		
	</head>
	
	<body>
    <div class="container-fluid">
			<?php include("../menu_carpetas.php"); ?>
		</div>
    <section class="container">
			<strong>
				<h2>Proveedores</h2>
			</strong>
			<hr>
			<!-- Button Modal Proveedores -->
			<div class="col-md-12 text-right">
				<button id="nuevo" type="button" class="btn btn-primary" >
					<i class="fa fa-plus"></i> Proveedor
				</button>
			</div >
		</section>
    <br>
		
    <section class="container">
			<table class="table table-striped">
				<tr class="success">
					<td><strong>ID</strong></td>
					<td><strong>Proveedor</strong></td>
					<td><strong>Acciones</strong></td>
				</tr>
				<?php foreach($proveedores AS $i=>$fila){	?>
					<tr class="">
						<td><?php echo $fila["id_proveedores"] ?></td> 
						<td><?php echo $fila["nombre_proveedores"] ?></td> 
						<td>
								<button class="btn btn-warning btn_editar" type="button" 
								data-id_registro="<?php echo $fila["id_proveedores"]?>"
								>
									<i class="fas fa-edit" ></i> Editar
								</button>
							
						</td> 
					</tr>
					<?php
					}
				?>
			</table>
			</section>

			<?php include('../scripts_carpetas.php'); ?>
			<?php include('forms/form_proveedores.php'); ?>
					
      <pre hidden id="debug">
        <?php print_r ($departamentos)?>
        // <?php echo var_dump ($departamentos)?>
      </pre>
					
	</body>
	<script>
		$("#nuevo").click(function(){
			$("#modal_edicion").modal("show")
			
		});
		
		$("#form_edicion").submit(guardarRegistro);
		$(".btn_editar").click(cargarDatos);
		
		function cargarDatos(event){
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
						"tabla": "proveedores",
						"id_campo": "id_proveedores",
						"id_valor": $id_registro						
						}
					}).done( function alTerminar (respuesta){					
						console.log("respuesta", respuesta);
						$boton.prop("disabled", false);
						$icono.toggleClass("fa-edit fa-spinner fa-spin"); 
						$("#modal_edicion").modal("show")
            $("#id_proveedores").val(respuesta.data.id_proveedores);                        
            $("#nombre_proveedor").val(respuesta.data.nombre_proveedores);                        
						
					})
		}
				
		function guardarRegistro(event){
      event.preventDefault()
      let $boton = $(this).find(':submit');
			let $icono = $(this).find(".fas");
      $boton.prop("disabled", true);
			$icono.toggleClass("fa-save fa-spinner fa-spin");				
			console.log("guardarRegistro")
			$.ajax({ 
        "url": "control/guardar_catalogo.php",
        "dataType": "JSON",
        "method": "POST",
        "data": {
            "tabla": "proveedores",
            "id_campo": $("#id_proveedores").val(),
            "name": $("#nombre_proveedor").val()
            
            }
        }).done( function alTerminar (respuesta){
            console.log("respuesta", respuesta);
            $boton.prop("disabled", false);
            $icono.toggleClass("fa-save fa-spinner fa-spin"); 
            $("#modal_edicion").modal("hide");
            window.location.reload(true);
        });
			
		}		
	</script>
</html>