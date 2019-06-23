
		<form id="form_venta">
			<div id="modal_venta" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-center">Finalizar Venta</h4>
				  </div>
				  <div class="modal-body">
						<div class="tabla_totales">
							<div class="row">
								<div class="col-md-12">
									<strong>Cantidad de productos: <span id="span_cantidad_productos"></span></strong>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<strong>Descuento:</strong>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-percent"></i></span>
										<input id="descuento_total" type="text" class="form-control" name="" size="50">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<strong>Pago con:</strong>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-usd"></i></span>
										<input id="pago_cantidad" type="text" class="form-control" name="" size="50">
									</div>
								</div>
							</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Cambio:</strong>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-usd"></i></span>
									<input id="cambio_cantidad" type="text" class="form-control" name="" size="50">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<strong>Total:</strong>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-usd"></i></span>
									<input id="total" type="text" class="form-control" name="" size="50">
								</div>
							</div>
						</div>
					</div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-usd"></i> Pagar</button>
				  </div>
				</div>

			  </div>
			</div>
			</div>
		</form>
		
		
		
		