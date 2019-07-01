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
			#respuesta_rep{
			color: red;
			}
		</style>
    <title>Productos</title>
		
		<?php include("styles.php");?>
		
	</head>
  <body>
		<div class="container-fluid">
			<?php include("menu.php");?>
		</div>
		
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
							<?php echo generar_select($link, "departamentos", "id_departamentos", "nombre_departamentos", true)?>
						</div>
						<div class="form-group">
							<label for="fecha_fin">Existencias:</label>
							<select  class="form-control"  name="existencia">
								<option value="">TODAS</option>
								<option value="minimo">DEBAJO DEL MINIMO</option>
							</select>
						</div>
						
						<button type="submit" class="btn btn-primary" id="btn_buscar">
							<i class="fa fa-search"></i> Buscar
						</button>
						
						<button type="button" class="btn btn-success pull-right" id="btn_alta">
							<i class="fa fa-plus"></i> Nuevo
						</button>
					</form>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-12 text-center table-responsive" id="lista_productos">
					
                    <table class="table table-bordered" id="tabla_productos">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Departamento</th>
                                <th class="text-center">Costo de Compra</th>
                                <th class="text-center">Ganancia</th>
                                <th class="text-center">Precio Venta</th>
                                <th class="text-center">Precio Mayoreo</th>
                                <th class="text-center">Mínimo</th>
                                <th class="text-center">Existencia</th>
                                <th class="text-center">Acciones</th>	
                            </tr>
							<tr>
							<th class="text-center">
								<input type="text" class="form-control buscar_descripcion" data-indice="0" placeholder="Buscar descripcion">
							</th>
							<th colspan="8">
							</th>
							</tr>
                        </thead>
                    
                    <tbody id="bodyProductos">                    
                        <tr>
                            <th class="text-center" colspan="9">
                                <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                            </th>
                        </tr>                   
                            
                    </tbody>

                    </table>
                    
				</div>
			</div>
		</div>
		<?php include('forms/productos.php'); ?>
		<?php include('forms/existencias.php'); ?>
		
		<?php  include('scripts.php'); ?>
		<script src="js/productos.js"></script>
		<script src="js/carrito.js"></script>
		<script src="https://unpkg.com/sticky-table-headers"></script>
	</body>
</html>