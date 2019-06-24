<form id="form_existencias">
	<div id="modal_existencias" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">

			<!-- Modal content--> 
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">AGREGAR INVENTARIO</h4>
				</div>
				<div class="modal-body">
					<input class="hidden" type="text" id="id_productos_inv" name="id_productos">
					<input class="hidden" type="text" name="tipo_movimiento" value="ENTRADA">
						<!--<div class="form-group ">
							<label for="existentes_contenedores">FECHA COMPRA</label>
							<input  type="date" class="form-control" id="fecha_movimiento" name="fecha_movimiento" value="<?php echo date("Y-m-d");?>">
						</div>-->
						<div class="form-group hidden">
							<label for="cantidad_contenedora">PIEZAS/KG POR CAJA O BULTO:</label>
							<input required readonly type="number" min="0" step=".01" class="form-control" id="cantidad_contenedora_inv" name="cantidad_contenedora">
						</div>
						<div class="form-group hidden">
							<label for="existencia_productos_inv">EXISTENCIA EN KG/ PIEZAS:</label>
							<input readonly type="text" min="0" class="form-control" id="existencia_productos_inv">
						</div>
						<div class="form-group ">
							<label for="existentes_contenedores">CANTIDAD</label>
							<input placeholder="CANTIDAD" type="number" min="0" step=".01" class="form-control" id="cantidad_entrada" required name="cantidad_entrada">
						</div>
						<div class="form-group ">
							<label for="existentes_contenedores">PRECIO</label>
							<input readonly placeholder="PRECIO" type="number" min="0" step=".01" class="form-control" id="precio_producto" required name="precio_producto">
						</div>
						<div class="form-group ">
							<label for="existentes_contenedores">IMPORTE</label>
							<input  readonly placeholder="IMPORTE" type="number" min="0" step=".01" class="form-control" id="importe_producto" required name="importe_producto">
						</div>
				</div>
			
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
					<button type="submit" class="btn btn-success" id="btn_formAlta"><i class="fa fa-floppy-o"></i> Guardar</button>
				</div>
			</div>
		</div>
	</div>
</form>