<form id="form_nuevo_egreso" class="form">
	<div id="modal_nuevo_egreso" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Egreso</h4>	
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							
							
							<div class="form-group">
								<label  for="" >Categoria:</label>
								<?php echo generar_select($link, "catalogo_egresos", "id_catalogo_egresos", "tipo_egreso", false, false, true)?>
							</div>
							<div class="form-group">
								<label  for="descripcion_egresos" class="text-center">Descripcion:</label>
								<input required type="text" class="form-control" name="descripcion_egresos" id="descripcion_egresos">
							</div>
							<div class="form-group">
								<label  for="cantidad_egresos" class="text-center">Cantidad:</label>
								<input required  type="number" min="0" step="any" class="form-control" name="cantidad_egresos" id="cantidad_egresos">
							</div>
							
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<i class="fa fa-times"></i> 
						Cerrar
					</button>
					<button type="submit" class="btn btn-success">
						<i class="fa fa-save" aria-hidden="true"></i> 
						Guardar
					</button>
		</div>
	</div>
</div>
</div>
</form>