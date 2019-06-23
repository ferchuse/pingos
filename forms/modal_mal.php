
			<div id="modal_granel" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-sm">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Calcular Granel</h4>
				  </div>
				  <div class="modal-body">
						<div class="tabla_granel">
							<div class="row">
								<div class="col-md-12">
									<label for="unidad_granel">Cantidad del producto:</label>
									<input id="unidad_granel" type="number" value="1" min="0" step="any" class="form-control" name="unidad_granel" size="50">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label for="costo_granel">Importe actual:</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-usd"></i></span>
										<input readonly id="costo_granel" type="text" step="any" class="form-control" name="costo_granel" size="50">
									</div>
								</div>
							</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<strong>Costo:<span id="costoventa_granel"></span></strong>
							</div>
						</div>
						<br>
					</div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
					<button type="submit" class="btn btn-success" id="agregar_granel"><i class="fa fa-plus"></i> Agregar</button>
				  </div>
				</div>

			  </div>
			</div>
			</div>
		