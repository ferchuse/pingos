<form id="form_nuevo_usuario" class="form">
	<div id="modal_nuevo_usuario" class="modal fade" role="dialog">
		<div class="modal-dialog modal-md">
<!--INICIO DEL MODAL -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Nuevo usuario</h4>	
				</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
							<!--INICIO DEL FORMULARIO -->
									<div class="row">
										<div class="col-md-6">
											<input id="new_usuarios" class="hidden" name="id_usuarios">
											<label for="nombre_usuarios" class="text-center">Usuario: </label>
											<input type="text" class="form-control" id="nombre_usuarios" name="nombre_usuarios" required>
										</div>
										<div class="col-md-6">
											<label for="pass_usuarios" class="text-center">Contraseña: </label>
											<input type="password" class="form-control" id="pass_usuarios" name="pass_usuarios" required>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<label for="nick_usuarios" class="text-center">Nick: </label>
											<input type="text" class="form-control" id="nick_usuarios" name="nick_usuarios" required>
										</div>
										<div class="col-md-6">
											<label for="permiso_usuarios" class="text-center">Permisos: </label>
											<select class="form-control" name="permiso_usuarios" id="permiso_usuarios" required>
												<option value="">Elije ...</option>
												<option value="administrador">Administrador</option>
												<option value="mostrador">Mostrador</option>
												<option value="caja">Caja</option>
												<option value="secretaria">Secretaria</option>
											</select>
										</div>
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
								<i class="fa fa-save"></i> 
								Guardar
							</button>
						</div>
			</div>
<!--FINAL DEL MODAL -->	
		</div>
	</div>
</form>