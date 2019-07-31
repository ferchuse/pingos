<form id="form_edicion" autocomplete="off">
	<div class="modal fade" id="modal_edicion" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content"> 
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Departamento</h4>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label for="id_departamentos">ID</label>
							<input style="margin:10px 0;" readonly type="text" class="form-control" id="id_departamentos" name="id_departamentos" placeholder="">
						</div>
						<div class="form-group">
							<label for="nombre_departamentos">Departamento</label>
							<input style="margin:10px 0;" required type="text" class="form-control" id="nombre_departamentos" name="nombre_departamentos" placeholder="">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
				</div>
			</div>
		</div>
	</div>
</form>