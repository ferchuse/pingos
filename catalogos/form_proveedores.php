<!-- Modal Proveedores
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Proveedor</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="id_proveedores">ID</label>
                        <input style="margin:10px 0;" type="text" class="form-control" id="id_proveedores" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="nombre_proveedores">Proveedor</label>
                        <input style="margin:10px 0;" type="text" class="form-control" id="nombre_proveedores" placeholder="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div> -->

<form id="form_edicion" autocomplete="off">
	<div class="modal fade" id="modal_edicion" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content"> 
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Proveedores</h4>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label for="id_proveedores">ID</label>
							<input style="margin:10px 0;" readonly type="text" class="form-control" id="id_proveedores" name="id_proveedores" placeholder="">
						</div>
						<div class="form-group">
							<label for="nombre_proveedor">Proveedor</label>
							<input style="margin:10px 0;" required type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" placeholder="">
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