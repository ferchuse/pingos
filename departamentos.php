<?php
	
	include("login/login_success.php");
	include("conexi.php");
	$link = Conectarse();
	$menu_activo = "catalogos";
	$consulta = "SELECT * FROM departamentos ";
	$result = mysqli_query($link, $consulta);
	
	if($result){
		while($fila = mysqli_fetch_assoc($result)){
			$departamentos[] = $fila;
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
    <title>Departamentos</title>
		
    <?php include("styles.php"); ?>
		
	</head>
	
	<body>
    <div class="container-fluid">
			<?php include("menu.php"); ?>
		</div>
    <section class="container">
			<strong>
				<h2>Departamentos</h2>
			</strong>
			<hr>
			<!-- Button Modal Proveedores -->
			<div class="col-md-12 text-right">
				<button id="nuevo" type="button" class="btn btn-success" >
					<i class="fa fa-plus"></i> Nuevo
				</button>
			</div >
		</section>
    <br>
		
    <section class="container">
			<table class="table table-striped">
				<tr class="success">
					<td><strong>ID</strong></td>
					<td><strong>Departamento</strong></td>
					<td><strong>Acciones</strong></td>
				</tr>
				<?php foreach($departamentos AS $i=>$fila){	?>
					<tr class="">
						<td><?php echo $fila["id_departamentos"] ?></td> 
						<td><?php echo $fila["nombre_departamentos"] ?></td> 
						<td>
								<button class="btn btn-warning btn_editar" type="button" 
								data-id_registro="<?php echo $fila["id_departamentos"]?>"
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
			
			
			
			
			
			<?php include('scripts.php'); ?>
			<?php include('forms/form_departamentos.php'); ?>
					
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
						"tabla": "departamentos",
						"id_campo": "id_departamentos",
						"id_valor": $id_registro						
						}
					}).done( function alTerminar (respuesta){					
						console.log("respuesta", respuesta);
						$boton.prop("disabled", false);
						$icono.toggleClass("fa-edit fa-spinner fa-spin"); 
						$("#modal_edicion").modal("show")
            $("#id_departamentos").val(respuesta.data.id_departamentos);                        
            $("#nombre_departamentos").val(respuesta.data.nombre_departamentos);                        
						
					})
		}
				
		function guardarRegistro(event){
      // event.preventDefault()
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
            "tabla": "departamentos",
            "id_campo": $("#id_departamentos").val(),
            "name": $("#nombre_departamentos").val()
            
            }
        }).done( function alTerminar (respuesta){
            console.log("respuesta", respuesta);
            $boton.prop("disabled", false);
            $icono.toggleClass("fa-save fa-spinner fa-spin"); 
            $("#modal_edicion").modal("hide");
               
        });
			// return false;
		}		
	</script>
</html>