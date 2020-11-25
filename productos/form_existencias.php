<?php
	
	
	$consulta_compras = "SELECT * FROM compras LEFT JOIN proveedores USING(id_proveedores) WHERE estatus_compras = 'PENDIENTE'";
	$result_compras = mysqli_query($link, $consulta_compras);
	$select = "<select class='form-control' id='id_compras' name='id_compras'";
	
	
	$select .= "<option value=''>Seleccione...</option>";
	while ($fila = mysqli_fetch_assoc($result_compras)) {
		
		
		
		$select.="<option value='{$fila["id_compras"]}>{$fila["id_compras"]} -  {$fila["nombre_proveedores"]}</option>";
		
	}
	
	$select.="</select>";
	
?>



<form id="form_existencias">
	<div id="modal_existencias" class="modal " role="dialog">
		<div class="modal-dialog modal-sm">
			
			<!-- Modal content--> 
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">AGREGAR A ORDEN DE COMPRA</h4>
				</div>
				<div class="modal-body">
					<div class="form-group ">
						<label for="existentes_contenedores">CANTIDAD</label>
						<input placeholder="CANTIDAD" type="number" value="1" step=".01" class="form-control" id="cantidad_carrito" required name="cantidad">
					</div>
					<div class="form-group " hidden>
						<label for="id_productos_carrito">ID:</label>
						<input  readonly type="number" min="0" step=".01" class="form-control" id="id_productos_carrito" name="id_productos">
					</div>
					<div class="form-group ">
						<label for="">Orden de Compra:</label>
						<?= $select?>
					</div>
					<div class="form-group " hidden>
						<label for="unidad_carrito">Unidad:</label>
						<input  readonly type="text" class="form-control" id="unidad_carrito" name="unidad">
					</div>
					<div class="form-group ">
						<label for="existencia_productos_inv">Descripción:</label>
						<input readonly type="text" class="form-control" id="descripcion_carrito" name="descripcion">
					</div>
					
					<div class="form-group ">
						<label for="existentes_contenedores">PRECIO</label>
						<input readonly placeholder="PRECIO" type="number" min="0" step=".01" class="form-control" id="precio_carrito"  name="precio">
					</div>
					<div class="form-group ">
						<label for="existentes_contenedores">IMPORTE</label>
						<input  readonly  type="number" min="0" step=".01" class="form-control" id="importe_carrito"  name="importe">
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
					<button type="submit" class="btn btn-success" id="btn_formAlta"><i class="fa fa-save"></i> Guardar</button>
				</div>
			</div>
		</div>
	</div>
</form>	